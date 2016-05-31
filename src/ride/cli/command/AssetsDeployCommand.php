<?php

namespace ride\cli\command;

use ride\library\system\file\browser\FileBrowser;

/**
 * Command to deploy the public assets from the modules
 */
class AssetsDeployCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Deploys all public files from the modules');

        $this->addArgument('destination', 'Path of the destination, defaults to the actual public directory', false);
        $this->addFlag('watch', 'Time to sleep in seconds before checking again');
    }

    /**
     * Invokes the command
     * @param ride\library\system\file\browser\FileBrowser $fileBrowser
     * @param string $destination
     * @return null
     */
    public function invoke(FileBrowser $fileBrowser, $destination = null, $watch = 0) {
        if ($destination) {
            $destination = $fileBrowser->getFileSystem()->getFile($destination);
            if (!$destination->exists()) {
                $destination->create();
            }
        } else {
            $destination = $fileBrowser->getPublicDirectory();
        }

        $this->output->writeLine($destination->getAbsolutePath());

        do {
            $includeDirectories = array_reverse($fileBrowser->getIncludeDirectories());
            foreach ($includeDirectories as $includeDirectory) {
                $modulePublic = $includeDirectory->getChild('public');
                if (!$modulePublic->exists()) {
                    continue;
                }

                $modulePublicAbsolute = $modulePublic->getAbsolutePath();

                $files = $modulePublic->read(true);
                foreach ($files as $file) {
                    if ($file->isDirectory()) {
                        continue;
                    }

                    $path = $file->getAbsolutePath();
                    $modificationTime = $file->getModificationTime();

                    if (isset($history[$path]) && $history[$path] >= $modificationTime) {
                        continue;
                    }

                    $history[$path] = $modificationTime;

                    $src = str_replace($modulePublicAbsolute . '/', '', $path);
                    $dst = $destination->getChild($src);

                    $this->output->writeLine($src . ' -> ' . $dst);

                    $file->copy($dst);
                }
            }

            sleep($watch);
        } while ($watch != 0);
    }

}

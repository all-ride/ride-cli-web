<?php

namespace pallo\cli\command;

use pallo\library\cli\command\AbstractCommand;
use pallo\library\system\file\browser\FileBrowser;

/**
 * Command to deploy the public assets from the modules
 */
class AssetsDeployCommand extends AbstractCommand {

    /**
     * Instance of the file browser
     * @var pallo\library\system\file\browser\FileBrowser
     */
    private $fileBrowser;

    /**
     * Constructs a new asset deploy command
     * @param pallo\library\system\file\browser\FileBrowser $fileBrowser
     * @return null
     */
    public function __construct(FileBrowser $fileBrowser) {
        parent::__construct('assets deploy', 'Deploys all public files from the modules');

        $this->addArgument('destination', 'Path of the destination, defaults to the actual public directory', false);

        $this->fileBrowser = $fileBrowser;
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $destination = $this->input->getArgument('destination');
        if ($destination) {
            $destination = $this->fileBrowser->getFileSystem()->getFile($destination);
            if (!$destination->exists()) {
                $destination->create();
            }
        } else {
            $destination = $this->fileBrowser->getPublicDirectory();
        }

        $this->output->writeLine($destination->getAbsolutePath());

        $includeDirectories = array_reverse($this->fileBrowser->getIncludeDirectories());
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

                $src = str_replace($modulePublicAbsolute . '/', '', $file->getAbsolutePath());
                $dst = $destination->getChild($src);

                $this->output->writeLine($src . ' -> ' . $dst);

                $file->copy($dst);
            }
        }
    }

}
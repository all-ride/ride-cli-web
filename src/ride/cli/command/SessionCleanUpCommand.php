<?php

namespace ride\cli\command;

use ride\library\http\session\io\SessionIO;

/**
 * Command to clean up the invalidated sessions
 */
class SessionCleanUpCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Cleans up the invalidated sessions');

        $this->addFlag('force', 'To clear all sessions');
    }

    /**
     * Invokes the command
     * @param ride\library\http\session\io\SessionIO $io
     * @param boolean $force
     * @return null
     */
    public function invoke(SessionIO $io, $force = null) {
        $io->clean($force);
    }

}
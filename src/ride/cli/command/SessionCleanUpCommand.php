<?php

namespace ride\cli\command;

use ride\library\cli\command\AbstractCommand;
use ride\library\http\session\io\SessionIO;

/**
 * Command to clean up the invalidated sessions
 */
class SessionCleanUpCommand extends AbstractCommand {

    /**
     * Instance of the Session I/O
     * @var ride\library\http\session\io\SessionIO
     */
    private $io;

    /**
     * Constructs a new session clean up command
     * @param ride\library\http\session\io\SessionIO $io
     * @return null
     */
    public function __construct(SessionIO $io) {
        parent::__construct('session clean', 'Cleans up the invalidated sessions');

        $this->addFlag('force', 'To clear all sessions');

        $this->io = $io;
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $force = $this->input->hasFlag('force');

    	$this->io->clean($force);
    }

}
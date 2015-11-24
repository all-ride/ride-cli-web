<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\service\RouterService;

/**
 * Command to add a new alias
 */
class AliasAddCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Add a new URL alias');

        $this->addArgument('path', 'Path of the URL');
        $this->addArgument('alias', 'Alias for the path');
        $this->addArgument('force', 'Force the alias for the provided path', false);
    }

    /**
     * Invokes the command
     * @param \ride\service\RouterService $routerService
     * @param string $path
     * @param string $alias
     * @param string $force
     * @return null
     */
    public function invoke(RouterService $routerService, $path, $alias, $force = false) {
        $alias = $routerService->createAlias($path, $alias, $force);

        $routerService->setAlias($alias);
    }

}

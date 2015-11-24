<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\service\RouterService;

use \Exception;

/**
 * Command to remove an alias
 */
class AliasRemoveCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Remove a URL alias');

        $this->addArgument('alias', 'Alias for the path');
    }

    /**
     * Invokes the command
     * @param \ride\service\RouterService $routerService
     * @param string $alias
     * @return null
     */
    public function invoke(RouterService $routerService, $alias) {
        $alias = $routerService->getAliasByAlias($alias);
        if (!$alias) {
            throw new Exception('Could not find alias ' . $alias);
        }

        $routerService->unsetAlias($alias);
    }

}

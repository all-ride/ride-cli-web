<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\service\RouterService;

/**
 * Command to search for aliases
 */
class AliasSearchCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Show an overview of the defined URL aliases');

        $this->addArgument('query', 'Query to search the URL aliases', false, true);
    }

    /**
     * Invokes the command
     * @param \ride\service\RouterService $routerService
     * @param string $query
     * @return null
     */
    public function invoke(RouterService $routerService, $query = null) {
        $aliases = $routerService->getAliases();

        if ($query) {
            foreach ($aliases as $id => $alias) {
                if (stripos($alias->getPath(), $query) !== false || stripos($alias->getAlias(), $query) !== false) {
                    continue;
                }

                unset($aliases[$id]);
            }
        }

        ksort($aliases);

        foreach ($aliases as $alias) {
            $this->output->writeLine($alias->getAlias() . ' -> ' . $alias->getPath() . ($alias->isForced() ? ' (force)' : ''));
        }
    }

}

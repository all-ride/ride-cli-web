<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\library\router\Router;

/**
 * Command to route a path
 */
class RouterRouteCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Routes the provided path');

        $this->addArgument('path', 'Path to route', false);
        $this->addArgument('method', 'Method of the request', false);
    }

    /**
     * Invokes the command
     * @param ride\library\router\Router $router
     * @param string $path
     * @param string $method
     * @return null
     */
    public function invoke(Router $router, $path = '/', $method = 'GET') {
        $routerResult = $router->route($method, $path);

        if (!$routerResult->isEmpty()) {
            $route = $routerResult->getRoute();
            if ($route) {
                $this->output->writeLine('200 Ok');
                $this->output->writeLine($route);
            } else {
                $allowedMethods = $routerResult->getAllowedMethods();
                $this->output->writeLine('405 Method not allowed');
                $this->output->writeLine('Allow: ' . implode(', ', $allowedMethods));
            }
        } else {
            $this->output->writeLine('404 Not found');
        }
    }

}
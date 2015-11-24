<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\service\RouterService;

/**
 * Command to remove a route
 */
class RouteRemoveCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Unregister a route');

        $this->addArgument('id', 'Id of the route');
    }

    /**
     * Invokes the command
     * @param \ride\service\RouterService $routerService
     * @param string $id
     * @return null
     */
    public function invoke(RouterService $routerService, $id) {
        $route = $routerService->getRouteById($id);
        if (!$route) {
            throw new Exception('Could not find route ' . $id);
        }

        $routerService->unsetRoute($route);
    }

}

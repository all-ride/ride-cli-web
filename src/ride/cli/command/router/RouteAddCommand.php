<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\service\RouterService;

/**
 * Command to add a new route
 */
class RouteAddCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Add a new route');

        $this->addArgument('path', 'Path of the route');
        $this->addArgument('controller', 'Class name of the controller');
        $this->addArgument('action', 'Action method (indexAction)', false);
        $this->addArgument('id', 'Id for the route', false);
        $this->addArgument('methods', 'Allowed methods for the route (eg get,head)', false);
    }

    /**
     * Invokes the command
     * @param \ride\service\RouterService $routerService
     * @param string $path
     * @param string $controller
     * @param string $action
     * @param string $id
     * @param string $methods
     * @return null
     */
    public function invoke(RouterService $routerService, $path, $controller, $action = 'indexAction', $id = null, $methods = null) {
        $callback = array($controller, $action);

        if ($methods) {
            $methods = implode(',', $methods);
        }

        $route = $routerService->createRoute($path, $callback, $id, $methods);

        $routerService->setRoute($route);
    }

}

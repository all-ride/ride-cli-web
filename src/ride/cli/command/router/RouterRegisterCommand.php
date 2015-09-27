<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\library\router\Route;

use ride\web\router\io\RouteContainerIO;

/**
 * Command to register a new route
 */
class RouterRegisterCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Register a new route');

        $this->addArgument('path', 'Path of the route');
        $this->addArgument('controller', 'Class name of the controller');
        $this->addArgument('action', 'Action method (indexAction)', false);
        $this->addArgument('id', 'Id for the route', false);
        $this->addArgument('methods', 'Allowed methods for the route (eg get,head)', false);
    }

    /**
     * Invokes the command
     * @param ride\web\router\io\RouteContainerIO $routeContainerIO
     * @param string $path
     * @param string $controller
     * @param string $action
     * @param string $id
     * @param string $methods
     * @return null
     */
    public function invoke(RouteContainerIO $routeContainerIO, $path, $controller, $action = 'indexAction', $id = null, $methods = null) {
        $callback = array($controller, $action);

        if ($methods) {
            $methods = implode(',', $methods);
        }

        $route = new Route($path, $callback, $id, $methods);

        $routeContainer = $routeContainerIO->getRouteContainer();
        $routeContainer->addRoute($route);

        $routeContainerIO->setRouteContainer($routeContainer);
    }

}
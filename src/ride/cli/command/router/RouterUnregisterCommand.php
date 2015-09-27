<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\web\router\io\RouteContainerIO;

/**
 * Command to unregister a route
 */
class RouterUnregisterCommand extends AbstractCommand {

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
     * @param ride\web\router\io\RouteContainerIO $routeContainerIO
     * @return null
     */
    public function invoke(RouteContainerIO $routeContainerIO, $id) {
        $routeContainer = $routeContainerIO->getRouteContainer();
        $routeContainer->removeRouteById($id);

        $routeContainerIO->setRouteContainer($routeContainer);
    }

}
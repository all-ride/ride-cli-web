<?php

namespace ride\cli\command\router;

use ride\library\cli\command\AbstractCommand;

use ride\web\router\io\RouteContainerIO;

/**
 * Command to unregister a route
 */
class RouterUnregisterCommand extends AbstractCommand {

    /**
     * Constructs a new route unregister command
     * @return null
     */
    public function __construct() {
        parent::__construct('router unregister', 'Unregister a route');

        $this->addArgument('id', 'Id of the route');
    }

    /**
     * Sets the route container IO
     * @param ride\web\router\io\RouteContainerIO $routeContainerIO
     * @return null
     */
    public function setRouteContainerIO(RouteContainerIO $routeContainerIO) {
        $this->routeContainerIO = $routeContainerIO;
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
    	$id = $this->input->getArgument('id');

    	$routeContainer = $this->routeContainerIO->getRouteContainer();
    	$routeContainer->removeRouteById($id);

    	$this->routeContainerIO->setRouteContainer($routeContainer);
    }

}
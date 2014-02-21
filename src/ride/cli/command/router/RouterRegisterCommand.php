<?php

namespace ride\cli\command\router;

use ride\library\cli\command\AbstractCommand;
use ride\library\router\Route;

use ride\web\router\io\RouteContainerIO;

/**
 * Command to register a new route
 */
class RouterRegisterCommand extends AbstractCommand {

    /**
     * Constructs a new route register command
     * @return null
     */
    public function __construct() {
        parent::__construct('router register', 'Register a new route');

        $this->addArgument('path', 'Path of the route');
        $this->addArgument('controller', 'Class name of the controller');
        $this->addArgument('action', 'Action method (indexAction)', false);
        $this->addArgument('id', 'Id for the route', false);
        $this->addArgument('methods', 'Allowed methods for the route (eg get,head)', false);
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
    	$path = $this->input->getArgument('path');
    	$controller = $this->input->getArgument('controller');
    	$action = $this->input->getArgument('action', 'indexAction');
    	$id = $this->input->getArgument('id');
    	$allowedMethods = $this->input->getArgument('methods');

    	$callback = array($controller, $action);

    	if ($allowedMethods) {
    		$allowedMethods = implode(',', $allowedMethods);
    	}

    	$route = new Route($path, $callback, $id, $allowedMethods);

    	$routeContainer = $this->routeContainerIO->getRouteContainer();
    	$routeContainer->addRoute($route);

    	$this->routeContainerIO->setRouteContainer($routeContainer);
    }

}
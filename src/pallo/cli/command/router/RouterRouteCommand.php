<?php

namespace pallo\cli\command\router;

use pallo\library\cli\command\AbstractCommand;
use pallo\library\router\Router;

/**
 * Command to route a path
 */
class RouterRouteCommand extends AbstractCommand {

    /**
     * Constructs a new route search command
     * @return null
     */
    public function __construct() {
        parent::__construct('router route', 'Routes the provided path');

        $this->addArgument('path', 'Path to route', false);
        $this->addArgument('method', 'Method of the request', false);
    }

    /**
     * Sets the router
     * @param pallo\library\router\Router $router
     */
    public function setRouter(Router $router) {
        $this->router = $router;
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
    	$path = $this->input->getArgument('path', '/');
    	$method = $this->input->getArgument('method', 'GET');

    	$routerResult = $this->router->route($method, $path);

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
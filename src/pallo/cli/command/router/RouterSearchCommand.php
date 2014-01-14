<?php

namespace pallo\cli\command\router;

use pallo\library\cli\command\AbstractCommand;
use pallo\library\router\Router;

/**
 * Command to search for routes
 */
class RouterSearchCommand extends AbstractCommand {

    /**
     * Constructs a new route search command
     * @return null
     */
    public function __construct() {
        parent::__construct('router', 'Show an overview of the defined routes');

        $this->addArgument('query', 'Query to search the routes', false, true);
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
        $routes = $this->router->getRouteContainer()->getRoutes();

        $query = $this->input->getArgument('query');
        if ($query) {
            foreach ($routes as $id => $route) {
                if (stripos($route->getPath(), $query) !== false) {
                    continue;
                }

                unset($routes[$id]);
            }
        }

        ksort($routes);

        foreach ($routes as $route) {
            $this->output->writeLine($route);
        }
    }

}
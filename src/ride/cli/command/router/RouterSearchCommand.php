<?php

namespace ride\cli\command\router;

use ride\cli\command\AbstractCommand;

use ride\library\router\Router;

/**
 * Command to search for routes
 */
class RouterSearchCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Show an overview of the defined routes');

        $this->addArgument('query', 'Query to search the routes', false, true);
    }

    /**
     * Invokes the command
     * @param \ride\library\router\Router $router
     * @param string $query
     * @return null
     */
    public function invoke(Router $router, $query = null) {
        $routes = $router->getRouteContainer()->getRoutes();

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
            $this->output->writeLine($route . ' (' . $route->getId() . ')');
        }
    }

}
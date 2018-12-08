<?php declare(strict_types = 1);

namespace App\Router;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


class RouterCollectionFactory
{
    public function create(): RouteCollection
    {
        $routes = new RouteCollection();

        $routes->add('test', new Route('/test', ['request-handler' => ['testHandler', 'get']]));
        $routes->add('report', new Route('/report', ['request-handler' => ['reportHandler', 'post']]));

        return $routes;
    }
}

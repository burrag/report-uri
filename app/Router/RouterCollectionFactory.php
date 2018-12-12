<?php declare(strict_types = 1);

namespace App\Router;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RouterCollectionFactory
{
    private const KEY_REQUEST_HANDLER = 'request-handler';

    public function create(): RouteCollection
    {
        $routes = new RouteCollection();

        $routes->add('test', new Route('/test', [self::KEY_REQUEST_HANDLER => ['testHandler', 'get']]));
        $routes->add('report', new Route('/report', [self::KEY_REQUEST_HANDLER => ['reportHandler', 'post']]));

        return $routes;
    }
}

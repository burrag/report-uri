<?php declare(strict_types = 1);

namespace App;

use DelOlmo\Middleware\SymfonyRouterMiddleware;
use Middlewares\RequestHandler;
use Middlewares\Utils\Dispatcher;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Routing\Router;

/**
 * @author Marek Humpolik <marek.humpolik@inspire.cz>
 */
class Application
{
    /** @var Router */
    private $router;

    /** @var ContainerInterface */
    private $container;

    public function __construct(Router $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $dispatcher = new Dispatcher([
            new SymfonyRouterMiddleware($this->router),
            new RequestHandler($this->container),
        ]);

        return $dispatcher->dispatch($request);
    }
}

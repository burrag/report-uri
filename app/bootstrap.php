<?php declare(strict_types = 1);

use App\Application;
use Nette\Configurator;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

const APP_DIR = __DIR__;

$configurator = new Configurator();
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->addConfig(__DIR__ . '/config.neon');

$container = $configurator->createContainer();

$request = ServerRequestFactory::fromGlobals();

/** @var Application $application */
$application = $container->getByType(Application::class);
$response = $application->run($request);
$emitter = new SapiEmitter();
$emitter->emit($response);

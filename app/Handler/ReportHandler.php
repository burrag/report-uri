<?php declare(strict_types = 1);

namespace App\Handler;

use App\Exception\InvalidCSPReportString;
use App\Object\CSP;
use App\Storage\IStorage;
use Psr\Http\Message\ServerRequestInterface;
use Tracy\Debugger;
use Zend\Diactoros\Response\EmptyResponse;

/**
 * Create CSP object and save
 *
 * @author Marek Humpolik <marek.humpolik@inspire.cz>
 */
class ReportHandler
{
    /** @var IStorage */
    private $storage;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function post(ServerRequestInterface $request)
    {
        $response = new EmptyResponse();

        try {
            $csp = CSP::createFromCSPReportString($request->getBody()->getContents());
            $this->storage->save($csp);
        } catch (InvalidCSPReportString $e) {
            Debugger::log($e);
            $response->withStatus(500);
        }

        return $response;
    }
}

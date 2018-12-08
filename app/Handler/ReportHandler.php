<?php declare(strict_types = 1);

namespace App\Handler;

use App\Object\CSP;
use App\Storage\IStorage;
use Psr\Http\Message\ServerRequestInterface;
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
        $csp = CSP::createFromCSPReportString($request->getBody()->getContents());
        $this->storage->save($csp);

        return new EmptyResponse();
    }
}

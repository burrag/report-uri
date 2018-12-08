<?php declare(strict_types = 1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Generate HTML with Content-Security-Policy header for report
 */
class TestHandler
{
    public function get(): ResponseInterface
    {
        return new HtmlResponse("<h1>Test page for CSP report</h1><script>console.log('test')</script>", 200, [
            'Content-Security-Policy' => 'script-src unsafe-inline; report-uri /report',
        ]);
    }
}

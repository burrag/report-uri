<?php declare(strict_types = 1);

namespace App\Object;

use App\Exception\InvalidCSPReportString;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class CSP
{
    /** @var string */
    private $blockedUri;

    /** @var string */
    private $documentUri;

    /** @var string */
    private $effectiveDirective;

    /** @var string */
    private $originalPolicy;

    /** @var string */
    private $sourceFile;

    /** @var string|null */
    private $violatedDirectives;

    /** @var string */
    private $referer;

    /** @var \DateTimeImmutable */
    private $reportDatetime;

    private function __construct(string $blockedUri, string $documentUri, string $effectiveDirective, string $originalPolicy, string $sourceFile, ?string $violatedDirectives, string $referer)
    {
        $this->blockedUri = $blockedUri;
        $this->documentUri = $documentUri;
        $this->effectiveDirective = $effectiveDirective;
        $this->originalPolicy = $originalPolicy;
        $this->sourceFile = $sourceFile;
        $this->violatedDirectives = $violatedDirectives;
        $this->referer = $referer;
        $this->reportDatetime = new \DateTimeImmutable('now');
    }

    public function getDomain(): string
    {
        return \parse_url($this->getDocumentUri(), \PHP_URL_HOST);
    }

    public function getReportDatetime(): \DateTimeInterface
    {
        return $this->reportDatetime;
    }

    /**
     * @return string
     */
    public function getBlockedUri(): string
    {
        return $this->blockedUri;
    }

    /**
     * @return string
     */
    public function getDocumentUri(): string
    {
        return $this->documentUri;
    }

    /**
     * @return string
     */
    public function getEffectiveDirective(): string
    {
        return $this->effectiveDirective;
    }

    /**
     * @return string
     */
    public function getOriginalPolicy(): string
    {
        return $this->originalPolicy;
    }

    /**
     * @return string
     */
    public function getSourceFile(): string
    {
        return $this->sourceFile;
    }

    /**
     * @return string
     */
    public function getViolatedDirectives(): ?string
    {
        return $this->violatedDirectives;
    }

    /**
     * @return string
     */
    public function getReferer(): string
    {
        return $this->referer;
    }

    public static function createFromCSPReportString(string $report): CSP
    {
        try {
            $cspArray = Json::decode($report, Json::FORCE_ARRAY);
        } catch (JsonException $e) {
            throw new InvalidCSPReportString('CSP report string is not valid', 0, $e);
        }

        $report = $cspArray['csp-report'];

        return new self(
            $report['blocked-uri'],
            $report['document-uri'],
            $report['effective-directive'],
            $report['original-policy'],
            $report['referrer'],
            $report['source-file'],
            $report['violated-directive']
        );
    }
}

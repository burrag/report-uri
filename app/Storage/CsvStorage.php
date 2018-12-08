<?php declare(strict_types = 1);

namespace App\Storage;

use App\Object\CSP;
use Nette\Utils\FileSystem;

/**
 * Save CSP to csv in rootProject/report
 */
class CsvStorage implements IStorage
{
    public function save(CSP $csp): void
    {
        FileSystem::createDir($this->createPathToSaveReport($csp));
        $resource = \fopen($this->createPathToCSVFile($csp), 'a+');

        \fputcsv($resource, [
            $csp->getReportDatetime()->format('Y-m-d H:i:s'),
            $csp->getDocumentUri(),
            $csp->getBlockedUri(),
            $csp->getEffectiveDirective(),
            $csp->getOriginalPolicy(),
            $csp->getReferer(),
            $csp->getViolatedDirectives(),
        ]);
    }

    private function createPathToSaveReport(CSP $csp): string
    {
        return \APP_DIR . '/../report/' . $csp->getReportDatetime()->format('o') . '/' . $csp->getReportDatetime()->format('n');
    }

    private function createPathToCSVFile(CSP $csp): string
    {
        return $this->createPathToSaveReport($csp) . '/report.csv';
    }
}

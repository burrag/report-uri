<?php declare(strict_types = 1);

namespace App\Storage;

use App\Object\CSP;

/**
 * Save CSP to storage
 *
 * @author Marek Humpolik <marek.humpolik@inspire.cz>
 */
interface IStorage
{
    public function save(CSP $csp): void;
}

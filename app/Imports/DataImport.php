<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Class DataImport
 * @package App\Imports
 */
class DataImport implements WithMultipleSheets
{
    /**
     * Handle sheets by one on one basis
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            0 => new PropertiesImport(),
            1 => new AnalyticTypesImport(),
            2 => new PropertyAnalyticsImport()
        ];
    }
}

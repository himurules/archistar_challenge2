<?php

namespace App\Imports;

use App\Models\AnalyticTypes;
use App\Models\PropertyAnalytics;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Class AnalyticTypesImport
 * @package App\Imports
 */
class AnalyticTypesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows All Rows
     *
     * @return AnalyticTypes
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            AnalyticTypes::create(
                [
                    'id'    => addslashes($row['id']),
                    'name'    => addslashes($row['name']),
                    'units'     => addslashes($row['units']),
                    'is_numeric'   => $row['is_numeric'],
                    'num_decimal_places'    => $row['num_decimal_places']
                ]
            );
        }
    }
}

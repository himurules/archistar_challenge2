<?php

namespace App\Imports;

use App\Models\PropertyAnalytics;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Class PropertyAnalyticsImport
 * @package App\Imports
 */
class PropertyAnalyticsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows All Rows
     *
     * @return PropertyAnalytics
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            PropertyAnalytics::create(
                [
                    'property_id'    => addslashes($row['property_id']),
                    'analytic_type_id'     => addslashes($row['anaytic_type_id']),
                    'value'   => addslashes($row['value'])
                ]
            );
        }
    }
}

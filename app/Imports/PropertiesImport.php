<?php

namespace App\Imports;

use App\Models\Properties;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Class PropertiesImport
 * @package App\Imports
 */
class PropertiesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows All Rows
     *
     * @return Properties
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Properties::create(
                [
                    'id'        => addslashes($row['property_id']),
                    'suburb'    => addslashes($row['suburb']),
                    'state'     => addslashes($row['state']),
                    'country'   => addslashes($row['counrty']),
                ]
            );
        }
    }
}

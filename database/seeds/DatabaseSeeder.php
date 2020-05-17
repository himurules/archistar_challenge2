<?php

use Illuminate\Database\Seeder;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Excel::import(new DataImport, 'BackEndTest_TestData_v1.1.xlsx', 'public');
    }
}

<?php

use Illuminate\Database\Seeder;

class StatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql/tbl_prospect_status.sql');
        DB::statement($sql);
    }
}

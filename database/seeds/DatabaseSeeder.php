<?php

// use App\Models\StatusMaster;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StatusMasterSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}

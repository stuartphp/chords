<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Database\Factories\DoctorFactory;
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
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            PermissionRoleSeeder::class,
            UserSeeder::class,
            RoleUserSeeder::class,
            //CategorySeeder::class,
           // UnitSeeder::class
        ]);
        \App\Models\Doctor::factory(20)->create();
    }
}

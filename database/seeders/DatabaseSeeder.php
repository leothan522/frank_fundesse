<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Rep98\Venezuela\Database\Seeders\CitySeeder;
use Rep98\Venezuela\Database\Seeders\MunicipalitySeeder;
use Rep98\Venezuela\Database\Seeders\ParishSeeder;
use Rep98\Venezuela\Database\Seeders\StateSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            StateSeeder::class,
            MunicipalitySeeder::class,
            ParishSeeder::class,
            CitySeeder::class,
        ]);
    }
}

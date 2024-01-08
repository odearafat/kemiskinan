<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Kabkot;
use App\Models\Desa;
use App\Models\Sls;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(10)->create();
         Kabkot::factory(38)->create();
         Kecamatan::factory(666)->create();
         Desa::factory(400)->create();
         //Sls::factory(500)->create();
        
         //\App\Models\Desa::factory(4000)->create();
        }
}

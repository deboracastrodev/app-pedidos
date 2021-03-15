<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\Cliente::factory()->count(30)->create(); 
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SupplierSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Revenda Mais User',
            'email' => 'user@revendamais.com.br',
            'password' => bcrypt('password'),
        ]);
        $this->call([
            SupplierSeeder::class,
        ]);
    }
}
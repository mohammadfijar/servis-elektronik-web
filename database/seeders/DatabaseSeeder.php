<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
            ItemSeeder::class,
            StockHistorySeeder::class,
            StockRequestSeeder::class,
            TransactionSeeder::class,
            ServiceSeeder::class,
            // … seeder lain kalau perlu
        ]);
    }
}
<?php
// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Elektronik', 'Furniture', 'Stationery', 'Servis'];
        foreach ($categories as $name) {
            Category::create(compact('name'));
        }
    }
}

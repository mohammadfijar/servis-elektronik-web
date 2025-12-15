<?php
// database/seeders/ItemSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $electronics = Category::where('name','Elektronik')->first();
        $furniture   = Category::where('name','Furniture')->first();

        Item::create([
            'category_id'    => $electronics->id,
            'name'           => 'TV LED 32 Inci',
            'brand'          => 'Samsung',
            'purchase_price' => 2000000,
            'selling_price'  => 2500000,
            'satuan_barang'  => 'unit',
            'stock'          => 10,
            'image'          => 'tv32.jpg',
        ]);

        Item::create([
            'category_id'    => $furniture->id,
            'name'           => 'Meja Kantor',
            'brand'          => 'IKEA',
            'purchase_price' => 500000,
            'selling_price'  => 750000,
            'satuan_barang'  => 'unit',
            'stock'          => 5,
            'image'          => 'meja.jpg',
        ]);
    }
}

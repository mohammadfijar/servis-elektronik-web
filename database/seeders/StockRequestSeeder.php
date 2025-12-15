<?php
// database/seeders/StockRequestSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockRequest;
use App\Models\Item;
use App\Models\Supplier;

class StockRequestSeeder extends Seeder
{
    public function run()
    {
        $supplier = Supplier::first();
        foreach (Item::take(2)->get() as $item) {
            StockRequest::create([
                'item_id'     => $item->id,
                'supplier_id' => $supplier->id,
                'qty'         => rand(1,10),
                'status'      => 'pending',
            ]);
        }
    }
}

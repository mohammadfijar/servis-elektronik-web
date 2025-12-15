<?php
// database/seeders/StockHistorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockHistory;
use App\Models\Item;

class StockHistorySeeder extends Seeder
{
    public function run()
    {
        foreach (Item::all() as $item) {
            $old = $item->stock;
            $new = $old + rand(1,5);
            StockHistory::create([
                'item_id'   => $item->id,
                'old_stock' => $old,
                'new_stock' => $new,
                'reason'    => 'Initial adjustment',
            ]);
        }
    }
}

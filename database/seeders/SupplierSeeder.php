<?php
// database/seeders/SupplierSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        Supplier::create([ 'name' => 'PT. Sumber Jaya', 'contact' => '081234567890', 'email' => 'sumberjaya@example.com' ]);
        Supplier::create([ 'name' => 'CV. Mitra Lagu',   'contact' => '081298765432', 'email' => 'mitralagu@example.com'   ]);
    }
}

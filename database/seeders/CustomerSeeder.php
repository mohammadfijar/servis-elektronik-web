<?php
// database/seeders/CustomerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([ 'name'=>'Budi Santoso','address'=>'Jakarta','telephone'=>'081111111','email'=>'budi@example.com','NIK'=>'1234567890123456' ]);
        Customer::create([ 'name'=>'Siti Aminah','address'=>'Bandung','telephone'=>'082222222','email'=>'siti@example.com','NIK'=>'6543210987654321' ]);
    }
}

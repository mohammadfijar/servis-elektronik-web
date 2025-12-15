<?php
// database/seeders/ServiceSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Item;
use App\Models\Customer;
use App\Models\User;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $item     = Item::first();
        $customer = Customer::first();
        $tech     = User::whereHas('roles', fn($q) => $q->where('name','staff'))->first();

        Service::create([
            'item_id'      => $item->id,
            'customer_id'  => $customer->id,
            'staff_id'     => $tech->id,
            'description'  => 'Perbaikan layar',
            'diagnosis'    => 'Retak pada panel LCD',
            'action_taken' => 'Ganti panel',
            'service_fee'  => 150000,
            'service_date' => now(),
            'status'       => 'completed',
        ]);
    }
}

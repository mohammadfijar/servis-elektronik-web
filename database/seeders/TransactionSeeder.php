<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Ambil beberapa customer dan staff
        $customers = Customer::all();
        $staffs = User::whereHas('roles', fn($q) => $q->where('name','staff'))->get();

        // Pastikan ada minimal 1 customer dan staff
        if($customers->isEmpty() || $staffs->isEmpty()) {
            $this->command->error('Harap buat customer dan staff terlebih dahulu!');
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            $transactionDate = $faker->dateTimeBetween('-6 months', 'now');
            $total = $faker->numberBetween(500000, 5000000);
            $discount = $faker->optional(0.3, 0)->numberBetween(0, 20); // 30% chance dapat diskon
            $grandTotal = $total - ($total * ($discount / 100));
            
            $paymentMethod = $faker->randomElement(['cash', 'card', 'transfer', 'ewallet']);
            $status = 'paid'; // Asumsi semua transaksi berhasil
            
            // Hitung uang bayar
            $paid = $grandTotal;
            if($faker->boolean(30)) { // 30% chance bayar lebih
                $paid += $faker->numberBetween(1000, 50000);
            }
            
            Transaction::create([
                'invoice_no'    => 'INV-'.Carbon::parse($transactionDate)->format('Ymd').'-'.sprintf('%03d', $i),
                'customer_id'   => $customers->random()->id,
                'staff_id'     => $staffs->random()->id,
                'total'         => $total,
                'paid'         => $paid,
                'change'        => max(0, $paid - $grandTotal),
                'discount'     => $discount,
                'grand_total'   => $grandTotal,
                'payment_method' => $paymentMethod,
                'status'        => $status,
                'created_at'    => $transactionDate,
                'updated_at'    => $transactionDate,
            ]);
        }
    }
}
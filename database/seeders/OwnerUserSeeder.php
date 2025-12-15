<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class OwnerUserSeeder extends Seeder
{
    public function run()
    {
        $owner = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name'     => 'Super Owner',
                'password' => Hash::make('ownerpass123'),
            ]
        );

        $ownerRole = Role::where('name', 'owner')->first();
        if ($ownerRole) {
            $owner->roles()->syncWithoutDetaching([$ownerRole->id]);
        }
    }
}

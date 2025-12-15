<?php
// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name'=>'Admin Utama','email'=>'admin@example.com','password'=>bcrypt('password'),'photo'=>null,'role'=>'admin'],
            ['name'=>'Owner Toko','email'=>'owner@example.com','password'=>bcrypt('password'),'photo'=>null,'role'=>'owner'],
            ['name'=>'Staff Service','email'=>'staff@example.com','password'=>bcrypt('password'),'photo'=>null,'role'=>'staff'],
        ];

        foreach ($users as $u) {
            $roleName = $u['role'];
            unset($u['role']);
            $user = User::create($u);
            $role = Role::where('name', $roleName)->first();
            $user->roles()->attach($role);
        }
    }
}

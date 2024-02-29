<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;


class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);

        // Create Admin User.
        $admin = User::create([
            'username' => 'Admin',
            'firstname' => 'Max',
            'lastname' => 'Musterman',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        // Assign role to user admin
        $admin->assignRole($admin_role);
    }
}

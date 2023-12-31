<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::updateOrCreate([


        //     'name' => 'admin',
        //     'email' => 'admin@example.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make(1234),
        //     'remember_token' => Str::random(10)

        // ]);

        // DB::table('users')->truncate();

        //crate admin
        // $adminRoleId = Role::where('role_slug','admin')->first()->id;

        // User::updateOrCreate([

        //     'role_id' => $adminRoleId,
        //     'name' => 'Admin User',
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make(1234),
        //     'is_active' => true,
        //     'remember_token' => Str::random(10)

        // ]);


        //create user
        $userRoleId = Role::where('role_slug','user')->first()->id;

        User::updateOrCreate([

            'role_id' => $userRoleId,
            'name' => 'Ekramul Hasan Mahi',
            'email' => 'mahi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make(12345),
            'is_active' => true,
            'remember_token' => Str::random(10)

        ]);


        //create manager
        // $managerRoleId = Role::where('role_slug','manager')->first()->id;

        // User::updateOrCreate([

        //     'role_id' => $managerRoleId,
        //     'name' => 'Manager User',
        //     'email' => 'manager@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make(1234),
        //     'is_active' => true,
        //     'remember_token' => Str::random(10)

        // ]);



    }
}

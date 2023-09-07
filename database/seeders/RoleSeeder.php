<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminPermission = Permission::select('id')->get();

        //admin role
        Role::updateOrCreate([

            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note' => 'allow all permission for admin',
            'is_deletable' => false

        ])->permissions()->sync($adminPermission->pluck('id'));


        //user role
        Role::updateOrCreate([

            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note' => 'allow limited permission for user',
            'is_deletable' => true

        ]);
    }
}

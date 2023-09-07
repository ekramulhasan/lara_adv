<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AdminPermissionDashboard = 'Access Dashboard';
        $PermissionRoleManagement = [

            'Index Role',
            'Create Role',
            'Edit Role',
            'Delete Role'
        ];

        $PermissionUserManagement = [

            'Index User',
            'Create User',
            'Edit User',
            'Detele User'
        ];

        //Admin Dashboard
        $dashboard_module_id = Module::where('module_name','Admin Dashboard')->select('id')->first();
        Permission::updateOrCreate([

            'module_id' => $dashboard_module_id->id,
            'permission_name' => $AdminPermissionDashboard,
            'permission_slug' => Str::slug($AdminPermissionDashboard),

        ]);


        //Role Management
        $role_module_id = Module::where('module_name','Role Management')->select('id')->first();
        for($i=0; $i<count($PermissionRoleManagement);$i++) {

            Permission::updateOrCreate([

                'module_id' => $role_module_id->id,
                'permission_name' => $PermissionRoleManagement[$i],
                'permission_slug' => Str::slug($PermissionRoleManagement[$i]),

            ]);

        }


        //User Management
        $user_module_id = Module::where('module_name','User Management')->select('id')->first();
        for($i=0; $i<count($PermissionUserManagement);$i++) {

            Permission::updateOrCreate([

                'module_id' => $user_module_id->id,
                'permission_name' => $PermissionUserManagement[$i],
                'permission_slug' => Str::slug($PermissionUserManagement[$i]),

            ]);

        }


    }
}

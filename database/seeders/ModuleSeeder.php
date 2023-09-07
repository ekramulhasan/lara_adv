<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleArray = [
            'Admin Dashboard',
            'Role Management',
            'User Management',
            'Permission Management'
        ];

        foreach ($moduleArray as $value) {

            Module::updateOrCreate([

                'module_name' => $value,
                'module_slug' => Str::slug($value)

            ]);


        }


    }
}

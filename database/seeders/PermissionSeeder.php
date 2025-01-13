<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run() : void
    {
        $permissions = [
            ['name' => 'addBlog', 'guard_name' => 'web'],
            ['name' => 'updateBlog', 'guard_name' => 'web'],
            ['name' => 'showBlog', 'guard_name' => 'web'],
            ['name' => 'deleteBlog', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $item) {
            Permission::updateOrCreate($item);
        }
    }
}
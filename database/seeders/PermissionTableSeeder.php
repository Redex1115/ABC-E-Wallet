<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()->create(['permission_name' => 'can_deposit']);
        Permission::factory()->create(['permission_name' => 'can_withdraw']);
        Permission::factory()->create(['permission_name' => 'can_transfer']);
    }
}

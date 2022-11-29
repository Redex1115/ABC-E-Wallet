<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserPermission::factory()->create([
            'user_id' => 1,
            'permission_id' => 1,
        ]);

        UserPermission::factory()->create([
            'user_id' => 1,
            'permission_id' => 2,
        ]);

        UserPermission::factory()->create([
            'user_id' => 1,
            'permission_id' => 3,
        ]);
    }
}

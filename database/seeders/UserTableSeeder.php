<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'loginID'      => 'Admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'accountLevel' => '1',
            'account_id' => '000000000000',
            'created_by'=> '0',
            'join_date' => Carbon::today(),
            'credit_limit' => 9999999,
        ]);
     
    }
}
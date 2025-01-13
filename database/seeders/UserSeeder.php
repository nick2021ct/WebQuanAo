<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'user1',
            'password' => Hash::make('123123123'), 
            'fullname' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0868098389',
            'address' => 'asdasdasd',
            'role' => 1, 
            'token' => Str::random(60), 
            'active' => true,
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null, 
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Gaston",
                "email" => "gaston.marcilio@gmail.com",
                'password' => bcrypt('123456'),
                'player_type' => 'h',
                'user_type' => 'p',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name" => "Paulo",
                "email" => "paulo@gmail.com",
                'password' => bcrypt('123456'),
                'player_type' => 'z',
                'user_type' => 'p',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name" => "admin",
                "email" => "admin@admin.com",
                'password' => bcrypt('123456'),
                'player_type' => '',
                'user_type' => 'a',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


        ];

        DB::table('users')->delete();
        DB::table('users')->insert($users);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ItemEquippedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipped = [
            [
                "user_id" => "2",
                "item_id" => "1",
                "type_item" => "armadura", 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "user_id" => "2",
                "item_id" => "2",
                "type_item" => "bota", 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "user_id" => "2",
                "item_id" => "3",
                "type_item" => "arma", 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "user_id" => "3",
                "item_id" => "1",
                "type_item" => "armadura", 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "user_id" => "3",
                "item_id" => "2",
                "type_item" => "bota", 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "user_id" => "3",
                "item_id" => "4",
                "type_item" => "arma", 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        
        DB::table('item_equippeds')->delete();
        DB::table('item_equippeds')->insert($equipped);

    }
}

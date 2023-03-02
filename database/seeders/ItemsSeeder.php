<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                "name" => "armadura",
                "item_type" => "armadura",
                "armour_points" => "10",
                "attack_points" => "0",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name" => "bota",
                "item_type" => "bota",
                "armour_points" => "3",
                "attack_points" => "0",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name" => "espada",
                "item_type" => "arma",
                "armour_points" => "0",
                "attack_points" => "5",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name" => "escopeta",
                "item_type" => "arma",
                "armour_points" => "0",
                "attack_points" => "15",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        DB::table('items')->delete();
        DB::table('items')->insert($items);
    }
}

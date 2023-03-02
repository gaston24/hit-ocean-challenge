<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeAttackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_attack = [
            [
                "name" => "cc",
                "power" => "1",
            ],
            [
                "name" => "d",
                "power" => "0.8",
            ],
            [
                "name" => "u",
                "power" => "2",
            ]

        ];
    }
}
?>
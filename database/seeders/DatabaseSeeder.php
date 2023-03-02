<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        $this->call([
            TypeAttackSeeder::class,
            UserSeeder::class,
            UserLifeSeeder::class,
            ItemsSeeder::class,
            InventorySeeder::class,
            ItemEquippedSeeder::class,

        ]);

        DB::statement("SET foreign_key_checks=1");
    }
}

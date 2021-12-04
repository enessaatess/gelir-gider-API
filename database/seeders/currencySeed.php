<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class currencySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('currency')->insert([
            0 =>
            array(
                'id' => 1,
                'name' => 'ABD DOLARI',
                'price' => 13.6801,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'EURO',
                'price' => 15.4548,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'TRY',
                'price' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
        ]);
    }
}

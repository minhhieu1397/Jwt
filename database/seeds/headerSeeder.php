<?php

use Illuminate\Database\Seeder;

class headerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header')->insert([
            'typ' => 'JWT',
            'alg' => 'HS256',
        ]);
    }
}

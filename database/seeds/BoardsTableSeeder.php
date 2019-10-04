<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('boards')->insert([
                'name' => 'Giorno Giovanna',
                'title' => 'Kore wa requiem da',
                'message' => 'wha- wha- wha- wha- wha- wha-',
                'image' => 'uwa.jpg',
                'password' => Hash::make('5555'),
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ]);
        }
    }
}

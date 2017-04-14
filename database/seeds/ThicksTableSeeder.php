<?php

use Illuminate\Database\Seeder;

class ThicksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thicks')->delete();
		$thicks = array (
			array(
				'id' => '1',
				'thick' => '0.6',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'thick' => '0.8',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '3',
				'thick' => '1',
				'created_at' => date('Y-m-d')
			)
		);
		DB::table('thicks')->insert($thicks);
    }
}

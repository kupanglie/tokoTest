<?php

use Illuminate\Database\Seeder;

class LengthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('lengths')->delete();
		$lengths = array (
			array(
				'id' => '1',
				'upper_length' => '5.8',
				'lower_length' => '5.0',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'upper_length' => '4.99',
				'lower_length' => '4.0',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '3',
				'upper_length' => '3.99',
				'lower_length' => '3.0',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '4',
				'upper_length' => '2.99',
				'lower_length' => '2.0',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '5',
				'upper_length' => '1.99',
				'lower_length' => '1.0',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '6',
				'upper_length' => '0.99',
				'lower_length' => '0',
				'created_at' => date('Y-m-d')
			)
		);
		DB::table('lengths')->insert($lengths);
    }
}

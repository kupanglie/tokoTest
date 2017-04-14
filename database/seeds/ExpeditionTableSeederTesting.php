<?php

use Illuminate\Database\Seeder;

class ExpeditionTableSeederTesting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('expeditions')->delete();
		$expeditions = array (
			array(
				'id' => '1',
				'name' => 'Expedition 1',
				'handphone_number' => '081339595464',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'Expedition 2',
				'handphone_number' => '081339595464',
				'created_at' => date('Y-m-d')
			)
		);
		DB::table('expeditions')->insert($expeditions);
    }
}

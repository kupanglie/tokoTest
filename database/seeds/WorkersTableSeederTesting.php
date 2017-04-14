<?php

use Illuminate\Database\Seeder;

class WorkersTableSeederTesting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('workers')->delete();
		$worker = array (
			array(
				'id' => '1',
				'name' => 'Worker 1',
				'identity_number' => '123456789',
				'address' => 'Jalan Test no 1',
				'handphone_number' => '081339595464',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'Worker 2',
				'identity_number' => '123456789',
				'address' => 'Jalan Test no 2',
				'handphone_number' => '081339595464',
				'created_at' => date('Y-m-d')
			),
		);
		DB::table('workers')->insert($worker);
    }
}

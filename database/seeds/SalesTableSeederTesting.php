<?php

use Illuminate\Database\Seeder;

class SalesTableSeederTesting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('sales')->delete();
		$sales = array (
			array(
				'id' => '1',
				'name' => 'Sales 1',
				'identity_number' => '123456789',
				'address' => 'Jalan Test no 1',
				'handphone_number' => '081339595464',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'Sales 2',
				'identity_number' => '123456789',
				'address' => 'Jalan Test no 2',
				'handphone_number' => '081339595464',
				'created_at' => date('Y-m-d')
			),
		);
		DB::table('sales')->insert($sales);
    }
}

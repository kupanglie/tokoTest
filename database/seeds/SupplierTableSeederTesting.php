<?php

use Illuminate\Database\Seeder;

class SupplierTableSeederTesting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('suppliers')->delete();
		$suppliers = array (
			array(
				'id' => '1',
				'name' => 'Supplier 1',
				'handphone_number' => '081339595464',
				'address' => 'Jalan Pemuda Pemudi No 1',
				'information' => 'Information 1',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'Supplier 2',
				'handphone_number' => '081339595464',
				'address' => 'Jalan Pemuda Pemudi No 2',
				'information' => 'Information 2',
				'created_at' => date('Y-m-d')
			)
		);
		DB::table('suppliers')->insert($suppliers);
    }
}

<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('categories')->delete();
		$categories = array (
			array(
				'id' => '1',
				'desc' => 'Small',
				'upper_range' => '100',
				'lower_range' => NULL,
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'desc' => 'Medium',
				'upper_range' => '500',
				'lower_range' => '101',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '3',
				'desc' => 'Big',
				'upper_range' => NULL,
				'lower_range' => '501',
				'created_at' => date('Y-m-d')
			),
		);
		DB::table('categories')->insert($categories);
    }
}

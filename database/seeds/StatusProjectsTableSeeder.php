<?php

use Illuminate\Database\Seeder;

class StatusProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('status_projects')->delete();
		$status_projects = array (
			array(
				'id' => '1',
				'desc' => 'Working',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'desc' => 'Pending',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '3',
				'desc' => 'Cancel',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '4',
				'desc' => 'Finish',
				'created_at' => date('Y-m-d')
			),
		);
		DB::table('status_projects')->insert($status_projects);
    }
}

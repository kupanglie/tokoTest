<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ThicksTableSeeder::class);
	    $this->call(LengthsTableSeeder::class);
		$this->call(ItemsTableSeeder::class);
		$this->call(WorkersTableSeederTesting::class);
		$this->call(SalesTableSeederTesting::class);
		$this->call(ExpeditionTableSeederTesting::class);
		$this->call(SupplierTableSeederTesting::class);
		$this->call(CategoriesTableSeeder::class);
		$this->call(StatusProjectsTableSeeder::class);
		$this->call(WorksTableSeeder::class);
    }
}

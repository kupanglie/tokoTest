<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('items')->delete();
		$items = array (
			array(
				'id' => '1',
				'name' => 'UP-001',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'UP-002',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '3',
				'name' => 'UP-003',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '4',
				'name' => 'UP-004',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '5',
				'name' => 'UP-005',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '6',
				'name' => 'UP-006',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '7',
				'name' => 'UP-007',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '8',
				'name' => 'UP-008',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '9',
				'name' => 'UP-009',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '10',
				'name' => 'UP-010',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '11',
				'name' => 'UP-011',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '12',
				'name' => 'UP-012',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '13',
				'name' => 'UP-013',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '14',
				'name' => 'UP-014',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '15',
				'name' => 'UP-015',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '16',
				'name' => 'UP-016',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '17',
				'name' => 'UP-017',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '18',
				'name' => 'UP-018',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '19',
				'name' => 'UP-019',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '20',
				'name' => 'UP-020',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '21',
				'name' => 'UP-021',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '22',
				'name' => 'UP-022',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '23',
				'name' => 'UP-023',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '24',
				'name' => 'UP-024',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '25',
				'name' => 'UP-025',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '26',
				'name' => 'UP-026',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '27',
				'name' => 'UP-027',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '28',
				'name' => 'UP-028',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '29',
				'name' => 'UP-037',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '30',
				'name' => 'UP-038',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '31',
				'name' => 'UP-039',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '32',
				'name' => 'UP-040',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '33',
				'name' => 'UP-041',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '34',
				'name' => 'UP-042',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '35',
				'name' => 'UP-043',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '36',
				'name' => 'UP-101',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '37',
				'name' => 'UP-102',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '38',
				'name' => 'UP-203',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '39',
				'name' => 'UP-204',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '40',
				'name' => 'UP-205',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '41',
				'name' => 'UP-206',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '42',
				'name' => 'UP-207',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '43',
				'name' => 'UP-208',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '44',
				'name' => 'UP-301',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '45',
				'name' => 'UP-302',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '46',
				'name' => 'LU-01-PUTIH',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '47',
				'name' => 'LU-01-COKLAT',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '48',
				'name' => 'LU-02',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '49',
				'name' => 'LU-03',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '50',
				'name' => 'LU-04',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '51',
				'name' => 'LU-06-PUTIH',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '52',
				'name' => 'LU-06-SILVER',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '53',
				'name' => 'LU-06-EMAS',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '54',
				'name' => 'LK-01-PARTISI',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '55',
				'name' => 'LK-02-PLAFON',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '56',
				'name' => 'LH-01-PUTIH',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '57',
				'name' => 'LH-01-COKLAT',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '58',
				'name' => 'LJ-021',
				'created_at' => date('Y-m-d')
			),
		);
		DB::table('items')->insert($items);
    }
}

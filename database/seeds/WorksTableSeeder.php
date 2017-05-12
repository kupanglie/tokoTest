<?php

use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('works')->delete();
		$works = array (
			array(
				'id' => '1',
				'name' => 'Pekerjaan plafon flat putih tinggi kurang dari 6 meter',
				'price' => '200000',
				'worker_cost' => '30000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'Pekerjaan plafon flat putih tinggi lebih dari 6 meter',
				'price' => '200000',
				'worker_cost' => '45000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '2',
				'name' => 'Pekerjaan plafon flat motif',
				'price' => '240000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '3',
				'name' => 'Pekerjaan plafon flat campur motif dan flat tanpa LH',
				'price' => '220000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '4',
				'name' => 'Pekerjaan plafon flat campur motif dan flat pakai LH',
				'price' => '250000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '5',
				'name' => 'Pekerjaan plafon drop celling rata putih 1 sisi dengan lebar kurang dari 1 meter',
				'price' => '100000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '6',
				'name' => 'Pekerjaan plafon drop celling rata motif 1 sisi dengan lebar kurang dari 1 meter',
				'price' => '120000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '7',
				'name' => 'Pekerjaan plafon drop celling rata putih 2 sisi dengan lebar kurang dari 1 meter',
				'price' => '200000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '8',
				'name' => 'Pekerjaan plafon drop celling rata motif 2 sisi dengan lebar kurang dari 1 meter',
				'price' => '240000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '9',
				'name' => 'Pekerjaan plafon lengkung (doom) putih',
				'price' => '240000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '10',
				'name' => 'Pekerjaan plafon lengkung (doom) motif',
				'price' => '288000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '11',
				'name' => 'Pekerjaan plafon drop celling gelombang putih dengan lebar kurang dari 1 meter',
				'price' => '240000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '12',
				'name' => 'Pekerjaan plafon drop celling gelombang motif dengan lebar kurang dari 1 meter',
				'price' => '288000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '13',
				'name' => 'Pekerjaan plafon drop celling bentuk "S" putih 1 sisi dengan lebar kurang dari 1 meter',
				'price' => '240000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '14',
				'name' => 'Pekerjaan plafon drop celling bentuk "S" motif 1 sisi dengan lebar kurang dari 1 meter',
				'price' => '288000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '15',
				'name' => 'Pekerjaan plafon drop celling bentuk "S" putih 2 sisi dengan lebar kurang dari 1 meter',
				'price' => '480000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '16',
				'name' => 'Pekerjaan plafon drop celling bentuk "S" motif 2 sisi dengan lebar kurang dari 1 meter',
				'price' => '576000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '17',
				'name' => 'Pekerjaan plafon trap putih tutup atas bawah 1 sisi',
				'price' => '150000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '18',
				'name' => 'Pekerjaan plafon trap putih tutup atas bawah 1 sisi',
				'price' => '180000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '19',
				'name' => 'Pekerjaan plafon trap putih tutup atas bawah 2 sisi',
				'price' => '300000',
				'created_at' => date('Y-m-d')
			),
			array(
				'id' => '20',
				'name' => 'Pekerjaan plafon trap putih tutup atas bawah 2 sisi',
				'price' => '360000',
				'created_at' => date('Y-m-d')
			),
		);
		DB::table('works')->insert($works);
    }
}

<?php

use App\Admin;
use App\Pekerja;
use App\Polis;
use App\Staf;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		// admin
		Pekerja::create([
			'nama' => 'Admin',
			'emel' => 'admin@gmail.com',
			'password' => bcrypt('1'),
			'no_pekerja' => 'K1',
			'no_ic' => '1',
			'no_tel_hp' => '1',
			'no_tel_pej' => '1',
			'log_pertama' => true,
			'jawatan' => '1',
			'jenis_pekerja' => '1'
		]);
		Admin::create([
			'pekerja_id' => '1'
		]);

		// staf
		Pekerja::create([
			'nama' => 'Nadzmi',
			'emel' => 'nadzmi@gmail.com',
			'password' => bcrypt('2'),
			'no_pekerja' => 'K2',
			'no_ic' => '950811026191',
			'no_tel_hp' => '01110849181',
			'no_tel_pej' => '044911376',
			'log_pertama' => true,
			'jawatan' => '2',
			'jenis_pekerja' => '2'
		]);
		Staf::create([
			'pekerja_id' => '2',
			'jabatan' => '2'
		]);

		// polis
		Pekerja::create([
			'nama' => 'Syahir',
			'emel' => 'syahir@gmail.com',
			'password' => bcrypt('3'),
			'no_pekerja' => 'K3',
			'no_ic' => '940221074373',
			'no_tel_hp' => '0183726472',
			'no_tel_pej' => '06377285',
			'log_pertama' => true,
			'jawatan' => '3',
			'jenis_pekerja' => '3'
		]);
		Polis::create([
			'pekerja_id' => '3',
			'pos' => '3'
		]);
	}
}

<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use CodeIgniter\Test\Fabricator;

class UserSeeder extends Seeder
{
	public function run()
	{
		$dataSingle = [
			"username" => "mauyuu",
			"email" => "maulanayuusuf023@gmail.com",
			"password" => "inipasshash",
			"address" => "soekarno hatta 99",
			"created_at" => Time::now("Asia/Jakarta"),
			"updated_at" => Time::now("Asia/Jakarta")
		];

		$dataMany = [
			[
				"username" => "mauyuu",
				"email" => "maulanayuusuf023@gmail.com",
				"password" => "inipasshash",
				"address" => "soekarno hatta 99",
				"created_at" => Time::now("Asia/Jakarta"),
				"updated_at" => Time::now("Asia/Jakarta")
			],
			[
				"username" => "suka",
				"email" => "sukaduka@gmail.com",
				"password" => "inipasshash2",
				"address" => "jalan suka duka jalan bersama",
				"created_at" => Time::now("Asia/Jakarta"),
				"updated_at" => Time::now("Asia/Jakarta")
			]
		];

		// Use Simple Query For single data
		// $this->db->query("INSERT INTO users (username, email, password, address, created_at, updated_at) VALUES (:username:, :email:, :password:, :address:, :created_at:, :updated_at:)", $data);

		// User query builder from ci4 for single data
		// $this->db->table("users")->insert($data);

		// User query builder from ci4 for many data (berbentuk array)
		// $this->db->table("users")->insertBatch($dataMany);

		// ci4 sudah menyediakan fitur data dummy yang mengambil dari library faker milik fzanynotto yaiyu Fabricator
		$faker = new Fabricator(model:User::class); # fabricator sudah menyetting data apa saja yang akan dimasukan, menurut yang ada di model yang dimasukan
		$dataFaker = $faker->make(5); # jika tidak ada parameter yang dimasukan, maka tidak ada data yang dibuat/null, 

		$this->db->table("users")->insertBatch($dataFaker);
	}
}

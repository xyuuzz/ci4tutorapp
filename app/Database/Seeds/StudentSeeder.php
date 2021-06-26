<?php

namespace App\Database\Seeds;

use App\Models\Student;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;

class StudentSeeder extends Seeder
{
	public function run()
	{
		$faker = new Fabricator(Student::class); # instansiasi object fabricator untuk generate data dummy pada model student.
		$faker->setOverrides(["image" => "default.png"]); # override value data dummy yang diberikan oleh fabricator, yaitu pada image dengan value nya adaa default.png
		$data = $faker->make(20); # buat data dummy sebanyak 20

		$this->db->table("students")->insertBatch($data); # masukan data ke dalam tabel students
	}
}

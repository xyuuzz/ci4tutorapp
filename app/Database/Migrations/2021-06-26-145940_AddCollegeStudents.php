<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCollegeStudents extends Migration
{
	public function up()
	{
		$fields = 
		[
			"id" => 
			[
				"type" => "INT",
				"constraint" => 11,
				"unsigned" => true,
				"auto_increment" => true
			],
			"university_id" => 
			[
				"type" => "INT",
				"contraint" => 11,
				"unsigned" => true
			],
			"study_program_id" =>
			[
				"type" => "INT",
				"constraint" => 11,
				"unsigned" => true
			],
			"name" => 
			[
				"type" => "VARCHAR",
				"constraint" => "100"
			],
			"address" =>
			[
				"type" => "VARCHAR",
				"constraint" => "255"
			],
			"created_at" => 
			[
				"type" => "datetime",
				"null" => true
			],
			"updated_at" => 
			[
				"type" => "datetime",
				"null" => true
			]
		];

		// buat field key id menjadi primary key
		$this->forge->addKey("id", true, true); 

		// tambahkan field nya
		$this->forge->addField($fields); 

		// tambahkan/buat key university_id menjadi foreign key untuk table universities yang merujuk/references pada key id
		$this->forge->addForeignKey("university_id", "universities", "id"); 
		
		// tambahkan/buat key study_program_id menjadi foreign key untuk table table study_programs yang merujuk/references pada key id
		$this->forge->addForeignKey("study_program_id", "study_programs", "id"); 

		// Buat Table dengan nama college_students. Ini adalah nama default table jika kita migration di laravel, Karena kita menggunakan CodeIgniter, maka table diberi nama tanpa dipisakan oleh _, yaitu collegestudents, hal ini dilakukan agar memudahkan konfigurasi pada model table... 
		$this->forge->createTable("college_students");
	}	

	public function down()
	{
		$this->forge->dropTable("college_students");
	}
}

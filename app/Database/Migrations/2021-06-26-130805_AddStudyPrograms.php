<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStudyPrograms extends Migration
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
			"name_study_program" => 
			[
				"type" => "VARCHAR",
				"constraint" => 255
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

		$this->forge->addKey("id", true, true);
		$this->forge->addField($fields);
		$this->forge->createTable("study_programs");
	}

	public function down()
	{
		$this->forge->dropTable("study_programs");
	}
}

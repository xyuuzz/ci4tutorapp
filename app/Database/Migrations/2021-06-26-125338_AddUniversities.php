<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniversities extends Migration
{
	public function up()
	{
		$fields = 
		[
			"id" => 
			[
				"type" => "INT",
				"constraint" => 11,
				"auto_increment" => true,
				"unsigned" => true
			],
			"name_university" => 
			[
				"type" => "VARCHAR",
				"constraint" => "100"
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
		$this->forge->createTable("universities");
	}

	public function down()
	{
		$this->forge->dropTable("universities");
	}
}

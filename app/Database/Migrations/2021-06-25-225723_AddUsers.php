<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id" => [
				"type" => "INT",
				"constraint" => 11,
				"unsigned" => TRUE,
				"auto_increment" => TRUE,
			],
			"username" => [
				"type" => "VARCHAR",
				"constraint" => "255",
			],
			"email" => [
				"type" => "VARCHAR",
				"constraint" => "255"
			],
			"password" => [
				"type" => "VARCHAR",
				"constraint" => "255"
			],
			"address" => [
				"type" => "VARCHAR",
				"constraint" => "255"
			],
			"created_at" => [
				"type" => "DATETIME",
				"null" => TRUE,
			],
			"updated_at" => [
				"type" => "DATETIME",
				"null" => TRUE,
			]
		]);

		// tables
		$this->forge->addKey("id", true, true);
		$this->forge->createTable("users");
	}

	public function down()
	{
		$this->forge->dropTable("users");
	}
}

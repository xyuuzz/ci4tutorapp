<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStudents extends Migration
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
            "name" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "slug" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "image" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => TRUE,
            ],
            "jenis_kelamin" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "ttl" => [
                "type" => "DATE",
                "null" => TRUE,
            ],
            "class" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "no_absen" => [
                "type" => "INT",
                "constraint" => "11",
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => TRUE
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => TRUE
            ],
        ]);

        $this->forge->addKey("id", true, true);
        $this->forge->createTable("students");
    }

    public function down()
    {
        $this->forge->dropTable(tableName:"students", cascade:true);
    }
}
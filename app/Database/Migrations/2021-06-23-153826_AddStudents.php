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
                "constraint" => "11",
                "unsigned" => true,
                "auto_increment" => true,
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
                "null" => true,
            ],
            "jenis_kelamin" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "ttl" => [
                "type" => "date",
                "null" => true,
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
                "type" => "datetime",
            ],
            "updated_at" => [
                "type" => "datetime",
            ],
        ]);

        $this->forge->addKey("id", true, true);
        $this->forge->createTable("students");
    }

    public function down()
    {
        $this->forge->dropTable("students");
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class CollegeStudent extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'college_students';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ["university_id", "study_program_id", "name", "address"];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	/*
	 * Serba Serbi Table Relationship pada MySQL
	 * 
	 * INNER JOIN 
	 * Adalah bentuk relasi table yang akan memunculkan data kedua table yang memenuhi kondisi yang dituliskan, Jika ada data diantara dua table yang tidak cocok, maka tidak akan ditampilkan... 
	 * Gambar : https://blog.codinghorror.com/content/images/uploads/2007/10/6a0120a85dcdae970b012877702708970c-pi.png
	 * 
	 * LEFT JOIN
	 * Adalah bentuk relasi table yang akan memunculkan semua data table sebelah kiri/table pertama yang didefinisikan apapun kondisi yang ditetapkan, untuk table sebelah kanan/table ke 2/table yang dijoinkan, jika tidak memenuhi kondisi, data akan di tampilkan, namun akan bernilai NULL...
	 * Gambar : https://i.stack.imgur.com/VkAT5.png
	 * 
	 * Right Join
	 * Sama Seperti LEFT JOIN, namun sekarang adalah table sebelah kanan/table yang didefinisikan ke 2/ table yang dijoinkan...
	 * Gambar : https://www.databasejournal.com/img/jk_JustSQL4_image004.jpg
	 * 
	 * Full Join
	 * Adalah bentuk relasi table yang akan menampilkan semua data diantara table tersebut, jika ada data yang tidak memenuhi kondisi diantara table tersebut, maka data tsb akan bernilai NULL...
	 * Gambar : https://i.stack.imgur.com/3Ll1h.png
	 * 
	 * 

	 ? Default Join Pada MySQL adalah INNER JOIN !

	 ! Sumber : https://www.geeksforgeeks.org/sql-join-set-1-inner-left-right-and-full-joins/
	 */

	# dapatkan data mahasiswa beserta data relasi mahasiswa universitas & prodi
	public function getMahasiswa() 
	{
		return $this->db->table("college_students") # select table mahasiswa
					->join("universities", "college_students.id = universities.id") # join table universitas dengan kondisi bahwa value dari column universitas_id pada mahasiswa = id universitas 
					->join("study_programs", "college_students.id = study_programs.id") # join table prodi dengan kondisi bahwa value dari column study_program_id pada mahasiswa = id study program
					->get() # dapatkan datanya
					->getResultObject(); # lalu dapatkan hasil nya dalam bentuk object
	}
}

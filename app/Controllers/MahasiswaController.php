<?php

namespace App\Controllers;

use App\Models\CollegeStudent;
use App\Controllers\BaseController;

class MahasiswaController extends BaseController
{
	protected $mahasiswa;
	
	public function __construct()
	{
		$this->mahasiswa = new CollegeStudent();
	}
	
	public function index()
	{
		dd($this->mahasiswa->getMahasiswa());	
	}
}

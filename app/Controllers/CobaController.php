<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CobaController extends BaseController
{
	public function index()
	{
		echo "ini adalah method index dari class coba controller";
	}

	public function about($nama, $waktu) # terima data yang dikirimkan oleh route
	{
		echo "Halo Pak $nama, Selamat $waktu";
	}
}
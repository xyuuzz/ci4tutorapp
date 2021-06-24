<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student;

class StudentController extends BaseController
{
    protected $student;

    public function __construct()
    {
        $this->student = new Student();
        // instansiasi model student ketika object StudentController dipanggil
    }

    public function index()
    {
        $data = [
            "title" => "Daftar Siswa",
            "listSiswa" => $this->student->getStudent(),
            "index" => 1,
            "validation" => \Config\Services::validation(),
        ];

        // connect database without models
        // $db = \Config\Database::connect();     => connect to db with method connect from Datsbase class
        // $siswa = $db->query("SELECT * FROM students");
        // dd($siswa->getResultArray());        => mendapatkan semua hasilny dan megubahnya menjadi bentuk array

        // connect database with models
        // $student = new Student();    => instansiasi model student
        // $listStudent = $student->findAll();    => ambil semua data pada model dan kembalikan sebagai array

        return view("pages/siswa/index", $data);
    }

    public function show($slug)
    {
        $student = $this->student->getStudent($slug);

        if (empty($student)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Siswa tidak ditemukan");
        }

        $data = [
            "title" => "Deskripsi Komik {$student['name']}",
            "student" => $student,
            "validation" => \Config\Services::validation()
        ];

        // jika komik yang dicari tidak ada

        return view("pages/siswa/detail", $data);
    }

    public function store()
    {
        // input validation 
        if ( !$this->validate(
        [
            "name" => [
                "rules" => "required|is_unique[students.name]",
                "errors" => [
                    "required" => "Field Nama Harus Diisi",
                    "is_unique" => "Nama Sudah Terdaftar"
                ]
            ],
            "ttl" => "required",
            "class" => "required|string|max_length[10]|min_length[4]",
            "no_absen" => "required|numeric|max_length[2]",
        ])
        )
        {
            session()->setFlashData("view", "create");

            $validation = \Config\Services::validation();
            return redirect()->to("/siswa")->withInput()->with("validation", $validation);
        }

        $slug = url_title($this->request->getVar("name"), "-", true);

        $this->student->save([
            "name" => $this->request->getVar("name"),
            "slug" => $slug,
            "image" => "pplinuxpng.png",
            "jenis_kelamin" => $this->request->getvar("jenis_kelamin"),
            "ttl" => $this->request->getVar("ttl"),
            "class" => $this->request->getVar("class"),
            "no_absen" => $this->request->getVar("no_absen"),
        ]);

        session()->setFlashData("success", "Berhasil Menambahkan Data Siswa");
        return redirect()->to("/siswa");
    }

    public function delete($id)
    {
        $this->student->delete($id);

        session()->setFlashData("success", "Berhasil Menghapus Data Siswa");
        return redirect()->to("/siswa");
    }

    public function update($id)
    {

        // input validation 
        if ( !$this->validate(
        [
            "name" => [
                "rules" => "required|is_unique[students.name,id,$id]|min_length[4]",
                "errors" => [
                    "required" => "Field Nama Harus Diisi",
                    "is_unique" => "Nama Sudah Terdaftar"
                ]
            ],
            "ttl" => "required",
            "class" => "required|string|max_length[10]|min_length[4]",
            "no_absen" => "required|numeric|max_length[2]",
        ])
        )
        {
            // cari field dengan $id yang dikirmkan, lalu ambil slug nya saja
            $slug_lama = $this->student->find($id)["slug"];
            session()->setFlashData("update", "view"); # kirim session flash update sebagai penanda

            $validation = \Config\Services::validation();
            return redirect()->to("/siswa/$slug_lama")->withInput()->with("validation", $validation);
        }

        $slug = url_title($this->request->getVar("name"), "-", true);

        $this->student->save([
            "id" => $id,
            "name" => $this->request->getVar("name"),
            "slug" => $slug,
            "image" => "pplinuxpng.png",
            "jenis_kelamin" => $this->request->getvar("jenis_kelamin"),
            "ttl" => $this->request->getVar("ttl"),
            "class" => $this->request->getVar("class"),
            "no_absen" => $this->request->getVar("no_absen"),
        ]);

        session()->setFlashData("success", "Data Siswa Berhasil diubah");
        return redirect()->to("/siswa");
    }
}
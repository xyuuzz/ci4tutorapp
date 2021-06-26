<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student;

class StudentController extends BaseController
{
    protected $student;

    public function __construct()
    {
        // instansiasi model student ketika object StudentController dipanggil
        $this->student = new Student();
    }

    public function index()
    {
        $cur_page = $this->request->getVar("page_users");
        $index = $cur_page ? ($cur_page * 5) - 4 : 1; 
        # rumus : (cur_page * page/hal) - page/hal - 1
        $data = [
            "title" => "Daftar Siswa",
            // "listSiswa" => $this->student->getStudent(),
            "listSiswa" => $this->student->paginate(5, "users"),
            "index" => $index,
            "validation" => \Config\Services::validation(),
            "pager" => $this->student->pager
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

    public function show($slug) # terima slug data yang dikirimkan dari url
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
            "name" => 
            [
                "rules" => "required|is_unique[students.name]",
                "errors" => [
                    "required" => "Field Nama Harus Diisi",
                    "is_unique" => "Nama Sudah Terdaftar"
                ]
            ],
            "ttl" => 
            [
                "rules" => "required",
                "errors" => [
                    "required" => "Tanggal tempat tanggal lahir harus diisi",
                ]
            ],
            "class" => 
            [
                "rules" => "required|string|max_length[10]|min_length[4]",
                "errors" => [
                    "required" => "Field kelas harus diisi",
                    "max_length" => "Max adalah 10 huruf",
                    "min_length" => "Min adalah 4 huruf",
                ]
            ],
            "no_absen" => 
            [
                "rules" => "required|numeric|max_length[2]",
                "errors" => [
                    "required" => "Field no absen harus diisi",
                    "max_length" => "max adalah 2 angka/puluhan",
                ]
            ],
            "image" => 
            [
                "rules" => "uploaded[image]|max_size[image,1024]|mime_in[image,image/jpg,image/jpeg,image/png]|is_image[image]",
                "errors" => [
                    "uploaded" => "Wajib mengunggah foto siswa!",
                    "max_size" => "ukuran foto max 1MB",
                    "mime_in" => "foto wajib berekstensi jpg, png atah jpeg",
                    "is_image" => "Hanya boleh mengunggah file foto, bukan yang lain!"
                ]
            ]
        ])
        )
        { // if input not validate
            session()->setFlashData("view", "create");

            // kirim pesan validation menggunakan method withInput() dan redirect ke halaman index dengan view create..
            return redirect()->to("/siswa")->withInput();

            // tidak dibutuhkan, hanya contoh
            // $validation = \Config\Services::validation();
            // return redirect()->to("/siswa")->withInput()->with("validation", $validation);
        }

        // image logic
        $img = $this->request->getFile("image");
        // pindah file ke folder public/images
        $img_name = explode(".", $img->getName())[0]; # ambil nama image tanpa extension nya
        $final_img_name =  $img_name . uniqid() . "." . $img->getExtension();
        $img->move("images", $final_img_name);

        $slug = url_title($this->request->getVar("name"), "-", true);

        $this->student->save([
            "name" => $this->request->getVar("name"),
            "slug" => $slug,
            "image" => $final_img_name,
            "jenis_kelamin" => $this->request->getvar("jenis_kelamin"),
            "ttl" => $this->request->getVar("ttl"),
            "class" => $this->request->getVar("class"),
            "no_absen" => $this->request->getVar("no_absen"),
        ]);

        // kirim pesan validation
        session()->setFlashData("success", "Berhasil Menambahkan Data Siswa");
        return redirect()->to("/siswa");
    }

    public function delete($id) # terima id yang dikirimkan dari url
    {
        $image_student = $this->student->find($id)["image"];
        if($image_student !== "default.png") # jika image student tidak bernilai default, maka hapus imagenya
        {
            unlink("images/$image_student");
        }

        $this->student->delete($id);

        // kirim pesan validation
        session()->setFlashData("success", "Berhasil Menghapus Data Siswa");
        return redirect()->to("/siswa");
    }

    public function update($id) # terima id yang dikirimkan dari url
    {
        // input validation 
        if ( !$this->validate(
        [
            "name" => 
            [
                "rules" => "required|is_unique[students.name,id,$id]|min_length[4]",
                "errors" => [
                    "required" => "Field Nama Harus Diisi",
                    "is_unique" => "Nama Sudah Terdaftar"
                ]
            ],
            "ttl" => 
            [
                "rules" => "required",
                "errors" => [
                    "required" => "Tanggal tempat tanggal lahir harus diisi",
                ]
            ],
            "class" => [
                "rules" => "required|string|max_length[10]|min_length[4]",
                "errors" => [
                    "required" => "Field kelas harus diisi",
                    "max_length" => "Max adalah 10 huruf",
                    "min_length" => "Min adalah 4 huruf",
                ]
            ],
            "no_absen" => [
                "rules" => "required|numeric|max_length[2]",
                "errors" => [
                    "required" => "Field no absen harus diisi",
                    "max_length" => "max adalah 2 angka/puluhan",
                ]
            ],
            "image" => 
            [
                "rules" => "max_size[image,1024]|mime_in[image,image/jpg,image/jpeg,image/png]|is_image[image]",
                "errors" => [
                    "max_size" => "ukuran foto max 1MB",
                    "mime_in" => "foto wajib berekstensi jpg, png atah jpeg",
                    "is_image" => "Hanya boleh mengunggah file foto, bukan yang lain!"
                ]
            ]
        ]))
        { # jika input tidak tervalidate / tidak memenuhi rules:
            // cari field dengan $id yang dikirmkan, lalu ambil slug nya saja
            $slug_lama = $this->student->find($id)["slug"];
            session()->setFlashData("update", "view"); # kirim session flash update sebagai penanda

            // kirim pesan validation menggunakan method withInput() dan redirect ke halaman detail siswa dengan view update
            return redirect()->to("/siswa/$slug_lama")->withInput();
        }

        // * jika user sudah tervalidate/ memenuhi rules

        // slug baru
        $slug = url_title($this->request->getVar("name"), "-", true);

        // jika user tidak menguploade gambar, gunakan yang lama
        $final_img_name = $this->student->find($id)["image"]; 

        // jika user menguplade file image
        if($this->request->getFile("image")->getError() !== 4) 
        {
            // dapatkan dan hapus gambar lama 
            $image_lama = $this->student->find($id)["image"];
            unlink("images/$image_lama");

            // dapatkan file gambar
            $img = $this->request->getFile("image");
            // nama image menggunakan gabungan dari nama image default dan uniqid()
            $img_name = explode(".", $img->getName())[0];
            $final_img_name =  $img_name . uniqid() . "." . $img->getExtension(); 
            // pindahkan file dari folder tmp, ke folder images di ci4
            $img->move("images", $final_img_name); 
        }

        // update student
        $this->student->save([ # pada ci4, update tetap menggunakan save
            "id" => $id, # jika create, id tidak ada(digenerate otomatis oleh ci4), namun jika update, diberi element id...
            "name" => $this->request->getVar("name"),
            "slug" => $slug,
            "image" => $final_img_name,
            "jenis_kelamin" => $this->request->getvar("jenis_kelamin"),
            "ttl" => $this->request->getVar("ttl"),
            "class" => $this->request->getVar("class"),
            "no_absen" => $this->request->getVar("no_absen"),
        ]);

        session()->setFlashData("success", "Data Siswa Berhasil diubah");
        return redirect()->to("/siswa/$slug");
    }

    public function search()
    {
        $result = "";
        $query = $this->request->getVar("query"); # menerima query yang dikirimkan oleh ajax

        if(strlen($query))
        {
            // disini kita connect ke db dengan cara manua,,
            $db      = \Config\Database::connect();# connect ke db
            $builder = $db->table('students'); # pilih table

            $result_q = $builder->like("name", $query)->get(5); # query table
            $index = 1; # index
            
            // jika result_q tidak menemukan data apapun..
            $result .= '<th scope="row" colspan="6" class="text-center">Tidak ada data nama siswa yang sama dengan yang anda cari</th>';

            // jika result_q menghasilkan count array > 0 / ada datanya :
            if(count($listSiswa = $result_q->getResultArray()))
            {
                foreach($listSiswa as $siswa)
                {
                    $result .= 
                    '<tr class="text-center">
                        <th scope="row">' . $index++ . '</th>
                        <td><img src="/images/' . $siswa["image"] . '" alt="foto siswa"
                                class="rounded-circle sampul">
                        </td>
                        <td>' . $siswa["name"] . '</td>
                        <td>' . $siswa["class"] . '</td>
                        <td>' . $siswa["jenis_kelamin"] . '</td>
                        <td class="text-center">
                            <a href="/siswa/' . $siswa["slug"] . '"
                                class="btn badge badge-secondary mr-2">Detail</a>
                        </td>
                    </tr>';
                }
            }
            echo $result;
        } 
        else { # jika tidak ada query yang dikirimkan maka kirim data default saja..
            $index = 1;
            foreach( $this->student->paginate(5) as $siswa ) # bisa paginate atau get, bebas
            {
                $result .= 
                '<tr class="text-center">
                    <th scope="row">' . $index++ . '</th>
                    <td><img src="/images/' . $siswa["image"] . '" alt="foto siswa"
                            class="rounded-circle sampul">
                    </td>
                    <td>' . $siswa["name"] . '</td>
                    <td>' . $siswa["class"] . '</td>
                    <td>' . $siswa["jenis_kelamin"] . '</td>
                    <td class="text-center">
                        <a href="/siswa/' . $siswa["slug"] . '"
                            class="btn badge badge-secondary mr-2">Detail</a>
                    </td>
                </tr>';
            }

            echo $result;
        }
        // karena aka ditankap oleh js, kita akan menggunakan echo, tidak return
    }
}
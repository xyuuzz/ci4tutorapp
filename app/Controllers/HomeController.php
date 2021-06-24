<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Home",
        ];

        return view("pages/home", $data); # panggil view home yang ada di folder page, dan kiriman data.
    }

    public function about()
    {
        $data = [
            "title" => "About Me",
        ];

        return view("pages/about", $data); # panggil view about yang ada di folder page, dan kiriman data.
    }

    public function contact()
    {
        $data = [
            "title" => "Contact Us",
            "alamat" => [
                [
                    "tipe" => "Kantor",
                    "alamat" => "JL. Soekarno Hatta 99",
                    "kota" => "Semarang",
                ],
                [
                    "tipe" => "Rumah",
                    "alamat" => "JL. Tambak Boyo Raya",
                    "kota" => "Semarang",
                ],
            ],
        ];

        return view("pages/contact", $data);
    }
}
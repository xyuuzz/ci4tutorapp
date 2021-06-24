<?php

namespace App\Controllers\Folder;

# jika file controller kita tidak berada tepat di dalam folder Controllers, maka kita wajib menambahkan nama folder pada namespace..

use App\Controllers\BaseController;

class DidalamFolderController extends BaseController
{
    public function index()
    {
        echo "halo, ini adalah method index dari class di dalam folder controler yang letaknya di dalam di app/folder";
    }
}
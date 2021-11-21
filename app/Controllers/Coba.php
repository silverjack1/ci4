<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
      echo 'Ini Controller Coba';
    }

    public function about($nama='',$umur='')
    {
      echo "Nama saya $nama, saya berumur $umur";
    }
}

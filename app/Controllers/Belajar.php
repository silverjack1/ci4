<?php

namespace App\Controllers;

use App\Models\KomikModel;
use App\Models\CustomModel;

class Belajar extends BaseController
{
    protected $komikModel;
    
    public function __construct()
    {
        $this->komikModel = new KomikModel();
        
    }
    public function index()
    {
        $siswa = [
            [
                'nama' => 'Muhammad Dian Nafi',
                'kelas' => 'VA',
                'jurusan' => [
                    'pilihan1' => '1',
                    'pilihan2' => 'PJOK'
                ]
            ],
            [
                'nama' => 'efwe',
                'kelas' => 'VA',
                'jurusan' => [
                    'pilihan1' => '2',
                    'pilihan2' => 'PJOK'
                ]
            ],
            [
                'nama' => 'asda',
                'kelas' => 'VA',
                'jurusan' => [
                    'pilihan1' => '3',
                    'pilihan2' => 'PGSD'
                ]
            ]

        ];
        foreach ($siswa as $s => $v) {

            foreach ($v as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $x => $y) {
                        echo $x . " = " . $y . "<br></br>";
                    }
                } else {
                    echo $key . " = " . $value . "<br></br>";
                }
            }
        }
        $languages = [];

        $languages['Python'] = array(
            "first_release" => "1991",
            "latest_release" => "3.8.0",
            "designed_by" => "Guido van Rossum",
            "description" => array(
                "extension" => ".py",
                "typing_discipline" => "Duck, dynamic, gradual",
                "license" => "Python Software Foundation License"
            )
        );

        // foreach ($languages as $key => $value) {

        // foreach ($value as $sub_key => $sub_val) {

        //     // If sub_val is an array then again
        //     // iterate through each element of it
        //     // else simply print the value of sub_key
        //     // and sub_val
        //     if (is_array($sub_val)) {
        //         echo $sub_key . " : <br></br>";
        //         foreach ($sub_val as $k => $v) {
        //             echo "\t" . $k . " = " . $v . "<br></br>";
        //         }
        //     } else {
        //         echo $sub_key . " = " . $sub_val . "<br></br>";
        //     }
        // }
        // }
    }
    
    public function faker(){
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            echo $faker->name, "<br>";
            echo $faker->address, "<br>";
        
          }
          
    }
    public function komik () {
        return view ('komik/ajax');
    }

    public function ajaxkomik() {
    	$model = new CustomModel;
		$all_data = $model->get();
        $data = [];
		foreach($all_data->getResult() as $key=>$row)
		{
            $kotak[] = $key;
            $kotak[] = $row->Name;
            $data[] = $kotak;
		
		}
        $output = ["data" => $data];
        dd(json_encode($output));

    }
}

<?php

namespace App\Controllers;
use \Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    public function index() {
 return view('costumers');
    }

public function basic()
{
    $db = db_connect();
    $builder = $db->table('video_games_sales')->select('id, Name, Genre, Publisher, NA_Sales, EU_Sales, JP_Sales');
    
    return DataTable::of($builder)->toJson();
}
}
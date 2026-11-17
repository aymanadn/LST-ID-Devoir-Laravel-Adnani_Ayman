<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function index()
    {
    $name = "Sir";
    $age = 40;

    $tab = array(
        'name' => "Sir",
        'age' => "43"
    );

    return view('myview', $tab);
    }
}
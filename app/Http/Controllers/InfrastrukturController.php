<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfrastrukturController extends Controller
{
    public function index(){
        return view('infrastruktur',[
            "title"=>"Infrastruktur"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        return view("index", ["title" => 'Home']);
    }
    public function about(){
        return view("about" , ["title" => 'About']);
    }
    public function contact(){
        return view("contact", ["title" => 'Contact']);
    }
}






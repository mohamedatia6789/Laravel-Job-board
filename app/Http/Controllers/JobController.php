<?php

namespace App\Http\Controllers;

use App\Models\jop;
use Illuminate\Http\Request;


class JobController extends Controller
{
    public function index()
    {
        $data = jop::getAllJobs();
        return view('index', ['data'=> $data , "name" => "Mohamed Atia"]);
    }
}

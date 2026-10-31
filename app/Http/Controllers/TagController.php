<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();

        return view("/Tags",["tags"=>$tags , "title"=>"Tags"]);
        }
    public function create(){
        Tag::Create([
            "name" => "waad Atia",
            ]);   
            return redirect("/Tags");    
            }
    public function deleting(){
        Tag::destroy(1);
        return redirect("/Tags");  
        }
        public function test(){

        return view("Post.test",[ "title"=>"test"]);
}
    
}

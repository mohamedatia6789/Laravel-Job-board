<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $posts = Post::latest()->cursorPaginate(5);

    // لو الصفحة المرجعة فاضية والمستخدم جاي من صفحة سابقة (معاه cursor)
    if ($posts->isEmpty() && request()->has('cursor')) {
        // نرجعه للصفحة اللي كان فيها فوراً
        return redirect()->back()->with("error","Post not found");

    }

    return view("Post.blog", [
        "posts" => $posts,
        "title" => "View",
        "count" => 1
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Post.create", ["title" => "Create Post"]);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidatePost $request)
    {
        
        $validated = $request->validated();

        $validated['published'] = $request->has('published');
        $validated['author'] = auth()->user()->name;
        $validated['user_id'] = auth()->id();
        Post::create($validated) ;
        
        
        return redirect("/blog")->with("success","Post created successfully");
    }    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("Post.show", ["post" => $post , "title" => "View Post"]); 
    }

    /**
     * Show the form for editing the specified resource.
     */    
    public function edit(Post $post)
    {
        return view("Post.edit", ["post" => $post , "title" => "Edit Post"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidatePost $request, Post $post)
    {
        
        $post->update($request->validated());
        return redirect("/blog")->with("success", "Post updated successfully");
            
    }
    public function updatePublished( Post $post)
    {

      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect("/blog")->with("success", "Post deleted successfully");
    }

    
}

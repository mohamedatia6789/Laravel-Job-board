<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateComment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommemtsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=Comment::paginate(2);
       return view("comment.index",["comments"=>$comments,"title"=>"Comments"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateComment $request)
    {

        $validated = $request->validated();
        Comment::create($validated);
        return redirect("/blog/" . $validated['post_id'])->with("success", "Comment created successfully");   
        } 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'تم حذف التعليق بنجاح');

    }
}

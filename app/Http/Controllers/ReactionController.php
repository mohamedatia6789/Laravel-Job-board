<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ReactionController extends Controller
{

public function toggleLike(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post);
        return back();
    }
}

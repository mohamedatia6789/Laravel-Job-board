<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = ["author", "body","post_id"]; // can change .
    protected $guarded = ["id"]; // read only .
    public function post(){
        return $this->belongsTo(Post::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'image', 'likes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentsCount()
    {
        return $this->hasMany(Comment::class)->count();
    }
}

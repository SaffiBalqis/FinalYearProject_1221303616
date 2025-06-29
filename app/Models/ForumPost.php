<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'content', 'category', 'image_path', 'agreed_to_guidelines'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

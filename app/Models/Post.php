<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public static function latestPosts(int $limit)
    {
        return self::latest()->take($limit)->get();
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}

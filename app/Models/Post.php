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

    public static function filterPosts(int $limit)
    {
        $posts = Post::with('user')->latest('id');
        $search = request()->input('search');
        if($search) {
            $posts = $posts->where('title', 'like', '%' . $search . '%')
                            ->orWhere('excerpt', 'like', '%' . $search . '%');
        }
        $author = request()->input('author');
        if($author) {
            $posts = $posts->whereHas('user', function($query) use($author){
                $query->where('name', $author);
            });
        }
        return $posts->paginate($limit);
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

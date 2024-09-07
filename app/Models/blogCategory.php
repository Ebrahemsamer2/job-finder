<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class blogCategory extends Model
{
    use HasFactory;

    public static function topCategories(int $limit)
    {
        return self::select('blog_categories.id', 'blog_categories.name', DB::raw('COUNT(posts.id) as posts_count'))
        ->join('posts', 'blog_categories.id', '=', 'posts.blog_category_id')
        ->groupBy('blog_categories.id')
        ->orderBy('posts_count', 'DESC')
        ->take($limit)
        ->get();
    }

    // Relations
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

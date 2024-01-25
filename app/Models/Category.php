<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public static function topCategories(int $limit)
    {
        return self::select('categories.id', 'categories.name', DB::raw('COUNT(jobs.id) as jobs_count'))
        ->join('jobs', 'categories.id', '=', 'jobs.category_id')
        ->groupBy('categories.id')
        ->orderBy('jobs_count', 'DESC')
        ->take($limit)
        ->get();
    }

    // Relations
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}

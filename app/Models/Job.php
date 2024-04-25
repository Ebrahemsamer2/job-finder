<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Resources\JobResource;

class Job extends Model
{
    use HasFactory;

    public static function featuredJobs(int $limit)
    {
        return self::latest()->take($limit)->get();
    }

    public static function loadJobs(Request $request) {
        $offset = $request->input('offset');
        $limit = $request->input('limit');

        $jobs = self::latest();

        return [
            'jobs' => JobResource::collection(
                $jobs->with('user')
                ->offset($offset)
                ->limit($limit)
                ->get()
            ),
            'count' => $jobs->count()
        ];
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

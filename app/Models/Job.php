<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Resources\JobResource;
use Carbon\Carbon;

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
        $job_types = $request->input('job_types');
        $expireneces = $request->input('expireneces');
        $posted_within = $request->input('posted_within');
        $category = $request->input('category');
        $location = $request->input('location');
        $salary_from = $request->input('salary_from');
        $salary_to = $request->input('salary_to');

        $jobs = self::latest();

        if(!empty($job_types)) {
            $jobs->whereIn("job_type", $job_types);
        }
        if(!empty($expireneces)) {
            $jobs->whereIn("expirenece", $expireneces);
        }
        if($category) {
            $jobs->where("category_id", $category);
        }
        if($location) {
            $location = explode("-", $location);
            $country = $location[0] ? trim($location[0]) : "";
            $city = $location[1] ? trim($location[1]) : "";
            if($country) {
                $jobs->where("country", $country);
            }
            if($city) {
                $jobs->where("city", $city);
            }
        }
        
        if($posted_within === 'today') {
            $jobs->where('created_at', Carbon::today());
        } else {
            $posted_within = explode('_', $posted_within);
            $posted_within = isset($posted_within[1]) ? (int) $posted_within[1] : 0;
            if($posted_within) {
                $jobs->where('created_at', '>=', Carbon::now()->subDays($posted_within));
            }
        }

        if($salary_from) {
            $jobs->where("salary_range_from", ">=", $salary_from);
        }
        if($salary_to) {
            $jobs->where("salary_range_to", "<=", $salary_to);
        }
        
        return [
            'count' => $jobs->count(),
            'jobs' => JobResource::collection(
                $jobs->with('user')
                ->offset($offset)
                ->limit($limit)
                ->get()
            ),
            
        ];
    }

    public function formatSkills() {
        return explode(';', $this->skills);
    }

    public function formatRequirements() {
        return explode(';', $this->requirements);
    }

    public function getRouteKeyName() {
        return 'slug';
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

    public function applicants() {
        return $this->belongsToMany(User::class, 'job_applications')->using(JobApplication::class)->withTimestamps();
    }
}

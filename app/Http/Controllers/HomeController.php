<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {
        return view('front.index', [
            'top_categories' => Category::topCategories(8),
            'featured_jobs' => Job::featuredJobs(5),
            'latest_posts' => Post::latestPosts(2),
        ]);
    }
}

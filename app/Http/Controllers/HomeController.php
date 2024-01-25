<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index() {
        return view('front.index', [
            'top_categories' => Category::topCategories(8),
        ]);
    }
}

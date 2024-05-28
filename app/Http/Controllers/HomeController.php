<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['categories'] = Category::orderBy('created_at', 'DESC')->get();
        $data['products'] = Product::orderBy('created_at', 'DESC')->limit('50')->get();
        return view('frontend.index', compact('data'));
    }

    public function products($slug)
    {
        $category = Category::where('slug', $slug)->with(['products' => function ($query) {
            $query->where('status', 'inactive')->get();
        }])->first();
        $data['categories'] = Category::orderBy('created_at', 'DESC')->get();
        return view("frontend.pages.product.index", compact('category', 'data'));
    }
}

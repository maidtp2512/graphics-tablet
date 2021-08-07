<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = new Product();
        $product_outstanding = $products::where('outstanding', '1')->take(8)->get();
        $product_discount = $products::where('discount', '>', 0)->take(8)->get();
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        $blogs = Blog::orderBy('created_at', 'DESC')->take(3)->get();
        return view('home', [
            'categories' => $data,
            'product_outstanding'=>$product_outstanding,
            'product_discount'=>$product_discount,
            'blogs'=>$blogs
        ]);
    }
    public function about()
    {
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        return view('client/about', [
            'categories' => $data
        ]);
    }
}
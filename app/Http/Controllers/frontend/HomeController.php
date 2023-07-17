<?php

namespace App\Http\Controllers\frontend;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\HeroBanner;

class HomeController extends Controller
{
    public function home(){


          //Blog
          $blogs = Blog::all();

          //Banner
          $banners = Banner::all();

          //Category
          $categories = Category::all();

          //Products
          $products = Product::simplePaginate(20);

          //Hero Banner
         $heroBanners = HeroBanner::all();

          //Latest Category
          $latestCategories = Category::latest()->limit(5)->get();
          $latestProducts = Product::where('status',1)->latest()->limit(12)->get();


        return view('frontend.pages.home',
        compact('categories','products','latestProducts','latestCategories','blogs','banners','heroBanners'));
    }

       public function categoryWiseProduct($id){

        $category = Category::findOrFail($id);

        $products = Product::where('category_id', $id)
        ->where('status', 1)->limit(20)
        ->get();



        return view('frontend.pages.catWizeProduct.categoryWizeProduct',compact('products','category'));
    }
}

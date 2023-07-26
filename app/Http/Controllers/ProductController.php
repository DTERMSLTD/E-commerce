<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\NewArrival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productForm(){

        $categories = Category::all();
        return view('backend.pages.product.productForm',compact('categories'));
    }

    public function productStore(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required',
            'image' => 'nullable|image|max:200',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|max:100',
            'time' => 'required',
            'description' => 'required',
            'product_information'=> 'required',
            'status'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $images = null;
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $images = date('Ymdi').'.'.$file->extension();
        $file->storeAs('uploads', $images, 'public');
        }
        //dd($imageName);
        // dd($request->all());


          Product::create([

            "name"=>$request->name,
            "category_id"=>$request->category_id,
            "image"=>$images,
            "weight"=>$request->weight,
             "stock"=>$request->stock,
             "price"=>$request->price,
             "discount"=>$request->discount,
             "time"=>$request->time,
             "description"=>$request->description,
             'product_information' =>$request->product_information,
             'status' =>$request->status,

          ]);

          return back()->with('success', 'Product Added Successfully!');

        }

        public function NewArrivalproductForm(){

            return view('backend.pages.product.newArrivalProductForm');
        }

          public function newProductStore(Request $request){



           // dd($request->all());

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'image' => 'nullable',
                'weight' => 'required|numeric',
                'stock' => 'required|integer',
                'price' => 'required|numeric',
                'discount' => 'nullable|numeric|max:100',
                'time' => 'required',
                'description' => 'required',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


        //dd($request->all());

            $imageName = null;
            if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = date('Ymdi').'.'.$file->extension();
            $file->storeAs('uploads', $imageName, 'public');

           // dd($imageName);
        }

              NewArrival::create([

             "name"=>$request->name,
             "image"=>$imageName,
             "weight"=>$request->weight,
             "stock"=>$request->stock,
             "price"=>$request->price,
             "discount"=>$request->discount,
             "time"=>$request->time,
             "description"=>$request->description,


          ]);

          return back()->with('success', 'New Arrival Added Successfully!');

    }

    public function NewArrivalproductList(){

        $products = NewArrival::latest()->get();

        return view('backend.pages.product.newArrivalProductList',compact('products'));
    }


        public function productList(){

            $products = Product::latest()->get();

            return view('backend.pages.product.productList',compact('products'));
        }

        public function productEdit($id){

            $categories = Category::all();

            $edit = Product::find($id);
            return view('backend.pages.product.edit',compact('edit','categories'));
        }

        public function productupdate( Request $request ,$id){


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required',
            'image' => 'nullable|image|max:200',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|max:100',
            'time' => 'required',
            'description' => 'required',
            'product_information'=> 'required',
            'status'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $images = null;
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $images = date('Ymdi').'.'.$file->extension();
        $file->storeAs('uploads', $images, 'public');
        }
            //dd($imageName);
           // dd($request->all());

            $update=Product::find($id);

            $update->update([
                "name"=>$request->name,
                "category_id"=>$request->category_id,
                "image"=>$images,
                "weight"=>$request->weight,
                 "stock"=>$request->stock,
                 "price"=>$request->price,
                 "discount"=>$request->discount,
                 "time"=>$request->time,
                 "description"=>$request->description,
                 'product_information' =>$request->product_information,
                 'status' =>$request->status,
            ]);
            Alert::toast()->success('Your post has been edited');
            return redirect()->route('product.list');

        }

        public function productDelete($id){

            $delete =  Product::find($id);
            $delete->delete();


            Alert::toast('Deleted! Product Deleted');

            return redirect()->back();
        }
}

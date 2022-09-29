<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;


use PDF;


class AdminController extends Controller
{
    public function view_category(){

        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request){

        $data = new category;
        $data->category_name = $request->category_name;

        $data->save();
        return redirect()->back()->with('msg','Category created successfully');

    }


    public function users(){

        $data = user::all();

        return view('admin.users',compact('data'));

    }

    public function deleteuser($id){

        $data = user::find($id);
        $data->delete();

        return redirect()->back()->with('msg','User deleted successfully');

    }

    public function delete_category($id){
        $data = Category::find($id);
        $data->delete();

        return redirect()->back()->with('msg', 'Category deleted successfully');
    }

    public function view_product(){

        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request){
        $product = new product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->dis_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image = $imagename;

        $product->save();
        return redirect()->back()->with('msg','Product added successfully');
    }

    public function show_product(){

        $product = product::all();

        return view('admin.show_product',compact('product'));
    }

    public function delete_product($id){

        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('msg','Product deleted successfully');

    }

    public function edit_product($id){

        $product = product::find($id);

        $category = Category::all();

        return view('admin.edit',compact('product','category'));
    }

    public function update_product(Request $request, $id){

        $product = product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->dis_price = $request->dis_price;
        

        $image = $request->image;

        if($image)
        {

        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);

        $product->image = $imagename;


        }

        

        $product->save();

        return redirect()->back()->with('msg', 'Product Updated Successfully');

    }

    public function order(){

        $order = order::all();


        return view('admin.order',compact('order'));

    }

    public function delivered($id){


        $order = order::find($id);

        $order->delivery_status = "delivered";

        $order->payment_status = "paid";

        $order->save();

        return redirect()->back();

    }

    public function print_pdf($id){

        $order = order::find($id);

        $pdf = PDF::loadView('admin.pdf',compact('order'));

        return $pdf->download('order_details.pdf');

    }

    public function search(Request $request){

        $search = $request->search; 

        $order = order::where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%")->get();

        return view('admin.order',compact('order'));
    

    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product; 

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;


class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(10);

        return view('home.userpage',compact('product'));
    }




    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype=='1') {

            $total_products = product::all()->count();

            $total_orders = order::all()->count();

            $total_customers = user::all()->count();


            $order = order::all();

            $total_revenue =0;

            foreach($order as $order)

            {

                $total_revenue = $total_revenue + $order->price;

            }

            $total_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();

            $total_processing = order::where('delivery_status', '=', 'processing')->get()->count();

            return view('admin.home',compact('total_products','total_orders','total_customers','total_revenue','total_delivered','total_processing'));
        }
        else {

            $user_id  = Auth::id();

            $count = cart::where('user_id',$user_id)->count();

        $product = Product::paginate(10);

        return view('home.userpage',compact('product'));
        }
    }




    public function product_details($id){

        $product = product::find($id);

        return view('home.product_detail',compact('product'));

    }

    public function add_cart(Request $request, $id){

        if(Auth::id()){

            $user = Auth::user();

            $product = product::find($id);
            
            $cart = new cart;

            $cart->name     = $user->name;

            $cart->email    = $user->email;

            $cart->address  = $user->address;

            $cart->user_id  = $user->id;



            $cart->title    = $product->title;

            if($product->dis_price!=null){
                $cart->price = $product->dis_price * $request->quantity;
            }
            else{
                $cart->price = $product->price * $request->quantity;
            }
            


            $cart->image = $product->image;

            $cart->product_id = $product->id;
            
            $cart->quantity = $request->quantity;



            $cart->save();

            return redirect()->back();
            }

            else{

            return redirect('login');

            }

    }

    public function show_cart(){

        if(Auth::id())
        {

            $id = Auth::user()->id;

        $cart = cart::where('user_id','=',$id)->get();
        

        return view('home.showcart',compact('cart'));


        }

        else{


            return redirect('login');


        }

    }

    public function remove_cart($id){

        $cart = cart::find($id);

        $cart->delete();

        return redirect()->back();

    }

    public function cash_order(){

        $user = Auth::user();

        $userid = $user->id;

        $cart = cart::where('user_id', '=',$userid)->get();


        foreach($cart as $cart){

            $order = new order;

            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->title = $cart->title;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->payment_status ='cash on delivery';
            $order->delivery_status ='processing';

            $order->save();

            $user_id = $cart->id;
            $cart = cart::find($user_id);
            $cart->delete();


        }

        return redirect()->back()->with('msg', 'We have Received Your Order');

    }

    public function stripe($totalprice){

        return view('home.stripe',compact('totalprice'));

    }


    public function stripePost(Request $request,$totalprice)
    {
      
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment." 
        ]);


        $user = Auth::user();

        $userid = $user->id;

        $cart = cart::where('user_id', '=',$userid)->get();


        foreach($cart as $cart){

            $order = new order;

            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->title = $cart->title;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->payment_status ='Paid';
            $order->delivery_status ='processing';

            $order->save();

            $user_id = $cart->id;
            $cart = cart::find($user_id);
            $cart->delete();


        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }


    public function show_order(){

        if(Auth::id()){

            $user = Auth::user();

            $userid = $user->id;

            $order = order::where('user_id','=',$userid)->get();

            return view('home.order',compact('order'));

        }

        else{

            return redirect('login');

        }



    }


    public function cancelorder($id){

        $order = order::find($id);

        $order->delivery_status = 'You canceled the order';

        $order->save();

        return redirect()->back();

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
                    ->select('orders.id as order_id', 'orders.quantity as quantity','orders.order_status as order_status', 'products.id as product_id', 'products.code as product_code', 'products.name as product_name', 'customers.email as customer_email')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->join('customers', 'customers.id', '=', 'orders.customer_id')
                    ->get();

        return view('Admin.all_orders',compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('Admin.new_order',compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'code' => 'required',
            'email' => 'required',
            'quantity' => 'required'
        ]);

    	$data=new Order;
        $data->product_code = $request->code;
    	$data->email= $request->email;
        $data->quantity = $request->quantity;
    	$data->order_status = 0;
        $data->save();
        return Redirect()->route('order.index');
    	
    }
     public function newStore(Request $request)
     {
        
        $validate = $request->validate([
            'code' => 'required',
            'email' => 'required',
            'quantity' => 'required'
        ]);

        // dd($request->all());
        $data=new Order;
        $data->product_id = $request->code;
        $data->customer_id= $request->email;
        $data->quantity = $request->quantity;
        $data->save();
        
        //customer_track
        // $customer = Customer::where('email', '=', $request->email)->first();
        // if($customer === null){
        //     $data3=new Customer;
        //     $data3->name= $request->name;
        //     $data3->email= $request->email;
        //     $data3->company = $request->company;
        //     $data3->address = $request->address;
        //     $data3->phone = $request->phone;
        //     $data3->save();
        // }
        return Redirect()->route('order.index');
        
    }

    public function pendingOrders(){
        $orders = Order::where('order_status','=','0')->get();
        return view('Admin.pending_orders',compact('orders'));
    }

    public function deliveredOrders(){
        $orders = Order::where('order_status','!=','0')->get();
        return view('Admin.delivered_orders',compact('orders'));
    }
}

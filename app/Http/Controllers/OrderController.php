<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request){
    	
    	$data=new Order;
    	$data->email= $request->email;
        $data->product_code = $request->code;
        $data->product_name = $request->name;
        $data->quantity = $request->quantity;
    	$data->order_status = 0;

        $data->save();
        return Redirect()->route('all.orders');
    	
    }

    public function ordersData(){
        $orders = Order::all();
        return view('Admin.all_orders',compact('orders'));
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

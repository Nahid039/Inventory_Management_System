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
                    ->select('orders.id as order_id', 'orders.quantity as quantity', 'orders.total_price as total_price', 'orders.order_status as order_status', 'products.id as product_id', 'products.code as product_code', 'products.name as product_name', 'customers.email as customer_email')
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
            'quantity' => 'required',

        ]);

    	$data=new Order;
        $data->product_code = $request->code;
    	$data->email= $request->email;
        $data->quantity = $request->quantity;
    	$data->order_status = 0;
        $data->total_price = $request->total_price;
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

        $data=new Order;
        $data->product_id = $request->code;
        $data->customer_id= $request->email;
        $data->quantity = $request->quantity;
        $data->total_price = $request->total_price;
        $data->save();
        
        return Redirect()->route('order.index');
        
    }

    public function pendingOrders()
    {
        $orders = Order::where('order_status','=','0')->get();
        return view('Admin.pending_orders',compact('orders'));
    }

    public function deliveredOrders()
    {
        $orders = Order::where('order_status','!=','0')->get();
        return view('Admin.delivered_orders',compact('orders'));
    }

    public function invoicesList()
    {
        $invoices = DB::table('orders')
                    ->where('order_status', 1)
                    ->select('orders.quantity as quantity', 'products.name as product_name', 'customers.name as customer_name', 'customers.company as company', 'orders.updated_at as created_at')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->join('customers', 'customers.id', '=', 'orders.customer_id')
                    ->get();

        return view('Admin.all_invoices', compact('invoices'));
    }

    public function createInvoice()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('Admin.new_invoice',compact('products','customers'));
    }
}

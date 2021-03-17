<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;



class InvoiceController extends Controller
{
    public function store(Request $request){
    	
    	$data=new Invoice;
        $data->customer_name= $request->customer;
    	$data->customer_mail= $request->email;
        $data->company = $request->company;
        $data->address = $request->address;
        $data->item = $request->item;
    	$data->product_name = $request->name;
    	$data->price = $request->unit_price;
    	$data->quantity = $request->quantity;
        $data->total = $request->total;
        $data->payment = $request->payment;
        $data->due = $request->total - $request->payment;

        $data->save();

        $products = DB::table('products')->where('category',$request->item)->first();
        $mainqty = $products->stock;
        $nowqty = $mainqty - $request->quantity;

        DB::table('products')->where('name',$request->name)->update(['stock' => $nowqty]);
        Order::where('email',$request->email)->update(['order_status'=>'1']);
        // print_r($mainqty);

        return view('Admin.invoice_details',compact('data'));


        // return Redirect()->route('add.invoice');
    }

    public function formData($id){
        $order = Order::where('id',$id)->first();
        $product = Product::where('product_code',$order->product_code)->first();
        $customer = Customer::where('email',$order->email)->first();
        return view('Admin.add_invoice',compact('order','product','customer'));
    }

    public function newformData(){
        $products = Product::all();
        $customers = Customer::all();
        return view('Admin.new_invoice',compact('products','customers'));
    }


    public function allInvoices(){
        $invoices = Invoice::all();
        return view('Admin.all_invoices',compact('invoices'));
    }

    public function soldProducts(){
        $products = Invoice::select('product_name', Invoice::raw("SUM(quantity) as count"))
        ->groupBy(Invoice::raw("product_name"))->get();
       // ?print_r($products);
        return view('Admin.sold_products',compact('products'));
    }

    public function delete(){
        Invoice::truncate();
    }
}

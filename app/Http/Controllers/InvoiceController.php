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
    public function index()
    {
        $invoices = Invoice::all();
        return view('Admin.all_invoices', compact('invoices'));
    }

    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('Admin.new_invoice', compact('products','customers'));
    }

    public function store(Request $request)
    {
        $data = new Customer;
        $data->name = $request->customer;
        $data->email = $request->email;
        $data->company = $request->company;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->save();

        $customer = DB::table('customers')
                        ->where('email', $request->email)
                        ->first();
        $customer_id = $customer->id;
        
        $data = new Order;
        $data->product_id = $request->code;
        $data->customer_id = $customer_id;
        $data->quantity = $request->quantity;
        $data->order_status = 1;
        $data->total_price = $request->total;
        $data->save();
        
        $products = DB::table('products')->where('id',$request->code)->first();
        $mainqty = $products->stock;
        $nowqty = $mainqty - $request->quantity;
        DB::table('products')->where('id',$request->code)->update(['stock' => $nowqty]);

        return view('Admin.invoice_details', compact('data'));
    }

    public function formData($id)
    {
        $order = Order::where('id',$id)->first();
        $product = Product::where('product_code',$order->product_code)->first();
        $customer = Customer::where('email',$order->email)->first();
        return view('Admin.add_invoice', compact('order','product','customer'));
    }

    public function soldProducts(){
        $products = Invoice::select('product_name', Invoice::raw("SUM(quantity) as count"))
        ->groupBy(Invoice::raw("product_name"))->get();
        return view('Admin.sold_products', compact('products'));
    }

    public function invoiceDetails()
    {
        return view('Admin.invoice_details');
    }
}

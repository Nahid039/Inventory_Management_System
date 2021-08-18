<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
                    ->orderBy('id')
                    ->get();

    	return view('Admin.all_product',compact('products'));
    }

    public function create()
    {
        return view('Admin.add_product');
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'unit_price' => 'required',
            'sale_price' => 'required'
        ]);
    	
    	$data=new Product;
        $data->code=$request->code;
    	$data->name= $request->name;
        $data->category = $request->category;
    	$data->stock = $request->stock;
    	$data->unit_price = $request->unit_price;
    	// $data->total_price = $request->stock * $request->unit_price;
        $data->sales_unit_price = $request->sale_price;
        // $data->sales_stock_price =$request->stock * $request->sale_price;


        $data->save();
        return Redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        return view('Admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'unit_price' => 'required',
            'sale_price' => 'required'
        ]);

        DB::table('products')
              ->where('code', $request->code)
              ->update([
                'code' => $request->code,
                'name' => $request->name,
                'category' => $request->category,
                'stock' => $request->stock,
                'unit_price' => $request->unit_price,
                'sales_unit_price' => $request->sale_price
            ]);

        return Redirect()->route('product.index');
    }

    public function delete(Product $product)
    {
        // DB::table('products')->where('id', $id)->delete();

        $product->delete();

        return Redirect()->route('product.index');
    }

    public function availableProducts()
    {
        $products = Product::where('stock','>','0')->get();
        return view('Admin.available_products',compact('products'));
    }
    public function formData($id){
        $product = Product::find($id);
        
        return view('Admin.add_order',compact('product'));
    }

    public function purchaseData($id){
        $product = Product::find($id);
        
        return view('Admin.purchase_products',compact('product'));
    }

    public function storePurchase(Request $request){

        Product::where('name',$request->name)
                ->update(['stock' => $request->stock + $request->purchase]);
        
        return Redirect()->route('product.index');
    }

}

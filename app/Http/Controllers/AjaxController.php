<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getPriceByProduct(int $productId)
    {
        $price = DB::table('products')
                    ->where('id', $productId)
                    ->value('sales_unit_price');
        
        return response()->json([
            'success' => true,
            'message' => "Data fetched successfully",
            'data' => $price,
        ]);
    } 
}

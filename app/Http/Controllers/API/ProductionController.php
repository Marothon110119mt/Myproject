<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Issue_Item;
use App\Models\Process_Item;
use App\Models\Purchases_Item;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\People;

class ProductionController extends Controller
{

    public function Pos(Request $request,$id)
    {
         $product =  Product::Where('id',$id)->first();
         $response = array();
            $response = array("value"=>$product->id,
            "label"=>$product->name .'-'.$product->code,
            "name"=>$product->name,
            "code"=>$product->code,
            "type"=>$product->type,
            "quantity"=>1,
            "price"=>$product->price,

        );
        return response()->json($response);
    }
    public function Category(Request $request,$id)
    {
        $product =  Product::Where('category',$id)->get();
        return response()->json($product);
    }
    public function Subcategory(Request $request,$id)
    {
        $product = DB::table('category')
        ->join('subcategory', 'category.subcategory', '=', 'subcategory.id')
        ->select('category.*', 'subcategory.id as subcategory_id')
        ->Where('subcategory',$id)
        ->get();
        return response()->json($product);
    }
    public function Brand(Request $request,$id)
    {
        $product =  Product::Where('brand',$id)->get();
        return response()->json($product);
    }
    public function customer(Request $request)
    {
         $products =  People::where('group_id', '1')->get();
        return response()->json($products);
    }

    public function customerbyid(Request $request,$id)
    {
         $products =  People::where('id', '1')->get();
        return response()->json($products);
    }

    public function Issue_item(Request $request,$id)
    {
         $products =  Issue_Item::Where('issue_id',$id)->get();
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->product_id,
           "label"=>$product->product_name .'-'.$product->product_code,
           "name"=>$product->product_name,
           "code"=>$product->product_code,
           "type"=>$product->product_type,
           "quantity"=>$product->product_quantity,);
        }
        return response()->json($response);
    }

    public function Process_Item(Request $request,$id)
    {
         $products =  Process_Item::Where('Process_id',$id)->get();
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->product_id,
           "label"=>$product->product_name .'-'.$product->product_code,
           "name"=>$product->product_name,
           "code"=>$product->product_code,
           "type"=>$product->product_type,
           "quantity"=>$product->product_quantity,);
        }
        return response()->json($response);
    }
    public function Pos_Item(Request $request,$id)
    {
         $products = DB::table('sale_item')
            ->join('product', 'sale_item.product_id', '=', 'product.id')
            ->select('sale_item.*')
            ->Where('sale_id',$id)
            ->get();
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->product_id,
           "label"    =>$product->product_name .'-'.$product->product_code,
           "name"     =>$product->product_name,
           "code"     =>$product->product_code,
           "cost"     =>$product->product_price,
           "quantity" =>$product->product_quantity,
           "discount" =>$product->product_discount ?? 0,
        //    "tax"      =>$product->product_tax,
        //    "type"     =>$product->type,
           "subtotal" =>$product->product_subtotal,
          );
        }
        return response()->json($response);
    }
    public function Purchases_Item(Request $request,$id)
    {
         $products = DB::table('purchases_item')
            ->join('product', 'purchases_item.product_id', '=', 'product.id')
            ->select('purchases_item.*', 'product.type')
            ->Where('purchases_id',$id)
            ->get();
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->product_id,
           "label"    =>$product->product_name .'-'.$product->product_code,
           "name"     =>$product->product_name,
           "code"     =>$product->product_code,
           "cost"     =>$product->product_cost,
           "quantity" =>$product->product_quantity,
           "discount" =>$product->product_discount,
           "tax"      =>$product->product_tax,
           "type"     =>$product->type,
           "subtotal" =>$product->product_subtotal,
          );
        }
        return response()->json($response);
    }

    public function payment_method(Request $request)
    {
         $products = DB::table('payment_method')->get();
        return response()->json($products);
    }
    public function product(Request $request)
    {
         $products = DB::table('product')->get();
        return response()->json($products);
    }
}

<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Issue_Item;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function getProducts(Request $request)
    {
        $search = $request->search;
        if($search == ''){
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->limit(10)->get();
        }else{
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->where('name', 'like', '%' .$search . '%')->orWhere('code','like', '%'.$search . '%',)->limit(10)->get();
        }
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->id,"label"=>$product->name .'-'.$product->code .'('. $product->type. ')',"name"=>$product->name,"code"=>$product->code,"price"=>$product->price,"quantity"=>'1',"cost"=>$product->cost,"discount"=>'0',"category"=>$product->category,"brand"=>$product->brand,"photo"=>$product->photo,"detail"=>$product->detail,);
        }
        return response()->json($response);
    }
    public function getIssue(Request $request)
    {
        $search = $request->search;
        if($search == ''){
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )
           ->where('type','!=','Final')
           ->Where('quantity','>=','1')
           ->limit(10)->get();
        }else{
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )
           ->where('type','!=','Final')
           ->Where('quantity','>=','1')
           ->whereRaw("concat(name, ' ', code) like '%" .$search. "%' ")
           ->limit(10)->get();
        }
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->id,"label"=>$product->name.'-'.$product->code,"name"=>$product->name,"code"=>$product->code,"price"=>$product->price,"quantity"=>'1',"cost"=>$product->cost,"discount"=>'0',"category"=>$product->category,"brand"=>$product->brand,"photo"=>$product->photo,"type"=>$product->type,"detail"=>$product->detail,);
        }
        return response()->json($response);
    }
    public function getRow(Request $request)
    {
        $search = $request->search;
        if($search == ''){
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand','row', 'category','unit','photo','detail','alert','hide','status','type' )
           ->where('type','Row')
           ->Where('row','>=','1')
           ->limit(10)
           ->get();
        }else{
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )
           ->Where('row','>=','1')
           ->Where('type','Row')
           ->whereRaw("concat(name, ' ', code) like '%" .$search. "%' ")
           ->limit(10)
           ->get();
        }
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->id,"label"=>$product->name.'-'.$product->code,"name"=>$product->name,"code"=>$product->code,"price"=>$product->price,"quantity"=>'1',"cost"=>$product->cost,"discount"=>'0',"category"=>$product->category,"brand"=>$product->brand,"photo"=>$product->photo,"type"=>$product->type,"detail"=>$product->detail,);
        }
        return response()->json($response);
    }
    public function getProcess(Request $request)
    {
        $search = $request->search;
        if($search == ''){
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->where('type','Middle')->limit(10)->get();
        }else{
           $products = Product::orderby('name','asc')->select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )
           ->where('type','Middle')
           ->whereRaw("concat(name, ' ', code) like '%" .$search. "%' ")
           ->limit(10)->get();
        }
        $response = array();
        foreach($products as $product){
           $response[] = array("value"=>$product->id,"label"=>$product->name.'-'.$product->code,"name"=>$product->name,"code"=>$product->code,"price"=>$product->price,"quantity"=>'1',"cost"=>$product->cost,"discount"=>'0',"category"=>$product->category,"brand"=>$product->brand,"photo"=>$product->photo,"type"=>$product->type,"detail"=>$product->detail,);
        }
        return response()->json($response);
    }

    public function getProductIssue(Request $request,$id)
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
}

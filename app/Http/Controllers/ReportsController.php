<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use App\Models\Purchases;
use App\Models\Purchases_Item;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\People;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Payment_method;
use Illuminate\Support\Facades\DB;
class ReportsController extends Controller
{
    //  * Product 
    public function Product()
    {
        $item = DB::table('product') ->select('product.*','pur.product_quantity as product_quantity','pur.product_price as product_price','sa.sale_quantity as sale_quantity','sa.sale_price as sale_price')

        ->leftjoin(DB::raw('(SELECT product_id,SUM(product_cost * product_quantity) as product_price, SUM(product_quantity) as product_quantity FROM purchases_item GROUP BY product_id) as pur'),
            function($join)
            {
                $join->on('pur.product_id', '=', 'product.id');
            })
        ->leftjoin(DB::raw('(SELECT product_id,SUM(product_price * product_quantity) as sale_price, SUM(product_quantity) as sale_quantity FROM sale_item GROUP BY product_id) as sa'),
        function($join)
        {
            $join->on('sa.product_id', '=', 'product.id');
        });
        $product = $item->get();
        return view('admin/reports/product', compact('product'));
    }
    //  * Category 
    public function Category(Request $request)
    {
        $sales = DB::table('sales')->select('sales.id','sales.date');
        if($request->warehouse){
           $sales->where('warehouse_id', $request->warehouse);
        }
        if((Request()->sart_date && Request()->end_date) != null){
          $sales->whereBetween('date', [$request->start_date.' 00:00:00', $request->end_date.' 23:59:59']);
        }
        $sales=$sales->get();
        foreach($sales as $key => $sale){
            $sale_id[] = "$sale->id";
            $itemsale = DB::table('sale_item')
            ->select(DB::raw('sale_item.product_id'),DB::raw('cat.catid'),DB::raw('SUM(sale_item.product_quantity) AS sa_quantity'),DB::raw('SUM(sale_item.product_price) AS sa_price'))
            ->leftjoin('product','product.id','sale_item.product_id')
            ->leftjoin(DB::raw('(SELECT id as catid FROM category GROUP BY id) as cat'),
                function($join)
                {
                $join->on('cat.catid', '=', 'product.category');
            })
            ->groupBy('sale_item.product_id')
            ->whereIn('sale_id',$sale_id)->get();
        }

        $category_id = DB::table('category')
            ->select(DB::raw('category.id'))
            ->get();
        $item = DB::table('category')
        ->select('category.id as id','category.name as name','category.code as code','category.photo as photo',DB::raw('SUM(pur.product_quantity) AS pur_quantity'),DB::raw('SUM(pur.product_cost) AS product_cost'),DB::raw('SUM(sa.sale_quantity) AS sale_quantity'),DB::raw('SUM(sa.sale_price) AS sale_price'))
        ->groupBy('category.id')
        ->leftjoin(DB::raw('(SELECT category,id as proid FROM product GROUP BY id) as pro'),
            function($join)
            {
                $join->on('pro.category', '=', 'category.id');
        })
        ->leftjoin(DB::raw('(SELECT product_id,SUM(product_cost * product_quantity) as product_cost, SUM(product_quantity) as product_quantity FROM purchases_item GROUP BY product_id) as pur'),
            function($join)
            {
                $join->on('pur.product_id', '=', 'pro.proid');
        })
        ->leftjoin(DB::raw('(SELECT product_id,SUM(product_price * product_quantity) as sale_price, SUM(product_quantity) as sale_quantity FROM sale_item GROUP BY product_id) as sa'),
            function($join)
            {
                $join->on('sa.product_id', '=', 'pro.proid');

        });

        $product = $item->get();
        $category = Category::select('id', 'name')->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        return view('admin/reports/category', compact('product','category','warehouse'));
    }
    //  * Brand 
    public function Brand(Request $request)
    {
        $item = DB::table('brand')
        ->select('brand.id as id','brand.name as name','brand.code as code','brand.photo as photo',DB::raw('SUM(pur.product_quantity) AS pur_quantity'),DB::raw('SUM(pur.product_cost) AS product_cost'),DB::raw('SUM(sa.sale_quantity) AS sale_quantity'),DB::raw('SUM(sa.sale_price) AS sale_price'))
        ->groupBy('brand.id')
        ->leftjoin(DB::raw('(SELECT brand,id as proid FROM product GROUP BY id) as pro'),
            function($join)
            {
                $join->on('pro.brand', '=', 'brand.id');
        })
        ->leftjoin(DB::raw('(SELECT product_id,SUM(product_cost * product_quantity) as product_cost, SUM(product_quantity) as product_quantity FROM purchases_item GROUP BY product_id) as pur'),
            function($join)
            {
                $join->on('pur.product_id', '=', 'pro.proid');
        })
        ->leftjoin(DB::raw('(SELECT product_id,SUM(product_price * product_quantity) as sale_price, SUM(product_quantity) as sale_quantity FROM sale_item GROUP BY product_id) as sa'),
            function($join)
            {
                $join->on('sa.product_id', '=', 'pro.proid');
        });
        $product = $item->get();
        $brand = Brand::select('id', 'name')->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        return view('admin/reports/brand', compact('product','brand','warehouse'));
    }

     //  * daily_sale 
     public function daily_sale(Request $request)
     {
        $date     = date('Y-m-d');
        $item = DB::table('sales')
         ->select('sales.*','payment_method.name as payment_name','warehouse.name as warehouse_name','people.name as customer_name')
         ->join('payment_method', 'sales.paying_by', '=', 'payment_method.id')
         ->join('warehouse', 'sales.warehouse_id', '=', 'warehouse.id')
         ->join('people', 'sales.customer_id', '=', 'people.id');
            if($request->warehouse){
                $item->where('warehouse_id', $request->warehouse);
            }
            if($request->customer){
                $item->where('customer_id', $request->customer);
            }
            if($request->payment_method){
                $item->where('paying_by', $request->payment_method);
            }
            if($date){
                $item->where(DB::raw("(DATE_FORMAT(sales.date,'%Y-%m-%d'))"), "=", $date);
            }
         $sales = $item->get();
         $customer = People::select('id','name')->where('group_id', '1')->get();
         $warehouse = Warehouse::select('id', 'name')->get();
         $payment_method = Payment_method::select('id', 'name')->get();
        return view('admin/reports/daily_sale', compact('sales','customer','payment_method','warehouse'));
     }
      //  * monthly_sale 
      public function monthly_sale(Request $request)
      {
         $date     = date('Y-m');
         $item = DB::table('sales')
          ->select('sales.*','payment_method.name as payment_name','warehouse.name as warehouse_name','people.name as customer_name')
          ->join('payment_method', 'sales.paying_by', '=', 'payment_method.id')
          ->join('warehouse', 'sales.warehouse_id', '=', 'warehouse.id')
          ->join('people', 'sales.customer_id', '=', 'people.id');
             if($request->warehouse){
                 $item->where('warehouse_id', $request->warehouse);
             }
             if($request->customer){
                 $item->where('customer_id', $request->customer);
             }
             if($request->payment_method){
                 $item->where('paying_by', $request->payment_method);
             }
             if($date){
                 $item->where(DB::raw("(DATE_FORMAT(sales.date,'%Y-%m'))"), "=", $date);
             }
          $sales = $item->get();
          $customer = People::select('id','name')->where('group_id', '1')->get();
          $warehouse = Warehouse::select('id', 'name')->get();
          $payment_method = Payment_method::select('id', 'name')->get();
         return view('admin/reports/monthly_sale', compact('sales','customer','payment_method','warehouse'));
      }
        //  * sale 
     public function sale(Request $request)
     {
        $item = DB::table('sales')
         ->select('sales.*','payment_method.name as payment_name','warehouse.name as warehouse_name','people.name as customer_name')
         ->join('payment_method', 'sales.paying_by', '=', 'payment_method.id')
         ->join('warehouse', 'sales.warehouse_id', '=', 'warehouse.id')
         ->join('people', 'sales.customer_id', '=', 'people.id');
            if($request->warehouse){
                $item->where('warehouse_id', $request->warehouse);
            }
            if($request->customer){
                $item->where('customer_id', $request->customer);
            }
            if($request->payment_method){
                $item->where('paying_by', $request->payment_method);
            }
         $sales = $item->get();
         $customer = People::select('id','name')->where('group_id', '1')->get();
         $warehouse = Warehouse::select('id', 'name')->get();
         $payment_method = Payment_method::select('id', 'name')->get();
        return view('admin/reports/sale', compact('sales','customer','payment_method','warehouse'));
     }
    //  * saleitem 
    public function sale_item(Request $request)
    {
        $item = DB::table('sales')
        ->select('sales.date as date','payment_method.name as payment_name','warehouse.name as warehouse_name','people.name as customer_name','sale_item.product_name','sale_item.product_quantity')
        ->join('payment_method', 'sales.paying_by', '=', 'payment_method.id')
        ->join('sale_item', 'sales.id', '=', 'sale_item.sale_id')
        ->join('warehouse', 'sales.warehouse_id', '=', 'warehouse.id')
        ->join('people', 'sales.customer_id', '=', 'people.id');
        $sales = $item->get();
    // return response()->json($sales);
        $customer = People::select('id','name')->where('group_id', '1')->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        $payment_method = Payment_method::select('id', 'name')->get();
        return view('admin/reports/sale_item', compact('sales','customer','payment_method','warehouse'));
    }
       //  * purchases 
       public function purchases(Request $request)
       {
          $item = DB::table('purchases')
           ->select('purchases.*','payment_method.name as payment_name','warehouse.name as warehouse_name','people.name as customer_name')
           ->join('payment_method', 'purchases.payment_method', '=', 'payment_method.id')
           ->join('warehouse', 'purchases.warehouse_id', '=', 'warehouse.id')
           ->join('people', 'purchases.supplier_id', '=', 'people.id');
              if($request->warehouse){
                  $item->where('warehouse_id', $request->warehouse);
              }
              if($request->customer){
                  $item->where('customer_id', $request->customer);
              }
              if($request->payment_method){
                  $item->where('payment_method', $request->payment_method);
              }
           $purchases = $item->get();
           $supplier = People::select('id','name')->where('group_id', '2')->get();
           $warehouse = Warehouse::select('id', 'name')->get();
           $payment_method = Payment_method::select('id', 'name')->get();
          return view('admin/reports/purchases', compact('purchases','supplier','payment_method','warehouse'));
       }
    //  * purchasesitem 
    public function purchases_item(Request $request)
    {
        $item = DB::table('purchases')
        ->select('purchases.date as date','purchases.reference_no','payment_method.name as payment_name','warehouse.name as warehouse_name','people.name as customer_name','sale_item.product_name','sale_item.product_quantity')
        ->join('payment_method', 'purchases.payment_method', '=', 'payment_method.id')
        ->join('sale_item', 'purchases.id', '=', 'sale_item.sale_id')
        ->join('warehouse', 'purchases.warehouse_id', '=', 'warehouse.id')
        ->join('people', 'purchases.supplier_id', '=', 'people.id');
        $sales = $item->get();
        $supplier = People::select('id','name')->where('group_id', '2')->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        $payment_method = Payment_method::select('id', 'name')->get();
        return view('admin/reports/purchases_item', compact('sales','supplier','payment_method','warehouse'));
    }
    
}

<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use App\Models\Pos;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Sale_Item;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\People;
use App\Models\Bot;
use App\Models\Payment_method;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        $payment_method = Payment_method::select('id', 'name')->get();
        $customer = People::select('id','name')->where('group_id', '1')->get();
        $brand = Brand::select('id', 'name','code','photo' )->get();
        $category = Category::select('id', 'name','code','photo','subcategory' )->get();
        return view('admin/pos/index', compact('product','warehouse','customer','payment_method','brand','category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $bot = Bot::select('id','chat_id','bot_id','token')->get()->first();
        // $bot_id  = 'bot'.$bot->bot_id;
        // $token   = $bot->token;
        // $chat_id = $bot->chat_id;
        $Pos = Pos::create([
            'type'          => 1,
            'customer_id'   => $request->customer,
            'warehouse_id'  => $request->warehouse,
            'total'         => $request->total,
            'paying_by'     => $request->paying_by,
            'total_item'    => $request->total_item,
            'paying_by'     => $request->paying_by,
            'discount'      => $request->discount,
            'payableprice'      => $request->payablePrice,
            'grand_total'      => $request->payablePrice,
            'payablepricekhmer' => $request->payablePricekhmer,
            'paid'          => $request->total_paying,
            'paid_khmer'    => $request->total_paying_khmer,
            'balance'       => $request->balance,
            'balancekhmer'  => $request->balancekhmer,
        ]);
        // Bot
        // $grandtotal  = $request->total;
        // $botdiscount = $request->discount ?? '0';
        // $date = date('Y-m-d');
        // $Marothon = file_GET_contents('https://api.telegram.org/'.$bot_id.':'.$token.'/sendMessage?chat_id='.$chat_id.'&text='."<a href='https://www.tiktok.com/@moulmarothon/'>Invoice</a>".'%0A'.'ថ្ងៃទី'." : ".$date.'%0A'.'ចំនួនសរុប' ." : ".$request->total.'$'.'%0A'.'បញ្ចុះតម្លៃ' ." : ".$botdiscount.'$'."&parse_mode=html");
        // end
        $sale_id          = $Pos->id;
        $product_id       = $request->product_id;
        $product_code     = $request->product_code;
        $product_name     = $request->product_name;
        $product_price    = $request->product_price;
        $product_subtotal = $request->product_subtotal;
        $product_quantity = $request->product_quantity;
        foreach($product_id as $key => $product){
            $sale_create = Sale_Item::create([
                'sale_id'      => $sale_id,
                'product_id'        => $product_id[$key],
                'product_code'      => $product_code[$key],
                'product_name'      => $product_name[$key],
                'product_price'      => $product_price[$key],
                'product_subtotal'  => $product_subtotal[$key],
                'product_quantity'  => $product_quantity[$key],
            ]);
            if ($sale_create) {
                $product = Product::findOrFail($product_id[$key]);
                $product->quantity -= $product_quantity[$key];
                $product->save();
            }
        }
        Alert::success('Create Sales Successful');
        return Redirect::to('pos/view/'.$sale_id);
    }
    public function custom(Pos $pos)
    {
        return view('admin/pos/custom');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function show(Pos $pos,$id)
    {
        $sale = Pos::Where('id',$id)->get()->first();
        $sale_item = Sale_Item::Where('sale_id',$id)
        ->get();
        return view('admin/pos/view', compact('sale','sale_item'));
    }
    public function modal_view(Pos $pos,$id)
    {
        $sale = Pos::Where('id',$id)->get()->first();
        $sale_item = Sale_Item::Where('sale_id',$id)
        ->get();
        return view('admin/pos/modal_view', compact('sale','sale_item'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pos $pos)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pos $pos)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos $pos)
    {
        //
    }
}

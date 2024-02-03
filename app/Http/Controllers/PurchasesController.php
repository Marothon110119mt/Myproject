<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use App\Models\Purchases;
use App\Models\Purchases_Item;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\People;
use App\Models\Payment_method;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchases::select('id', 'reference_no','supplier_id','warehouse_id','note','total','grand_total','total_discount','shipping','paid','payment_method','created_at','updated_at')->latest()->get();
        return view('admin/purchases/index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->get();
        // var_dump($product); die();
        $warehouse = Warehouse::select('id', 'name')->get();
        $payment_method = Payment_method::select('id', 'name')->get();
        $supplier = People::select('id','name')->where('group_id', '2')->get();
        return view('admin/purchases/create', compact('product','warehouse','supplier','payment_method'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Purchases = Purchases::create([
            'date'  =>date('Y-m-d H:i:s' , strtotime($request->date)),
            'reference_no'  => $request->reference ?? 'Marothon',
            'supplier_id'   => $request->supplier,
            'warehouse_id'  => $request->warehouse,
            'payment_method'=> $request->payment_method,
            'note'          => $request->note,
            'total'         => $request->total,
            'grand_total'   => ($request->total-$request->total_discount)+$request->shipping,
            'total_discount'=> $request->total_discount ?? '0',
            'shipping'      => $request->shipping ?? '0',
            'paid'          => $request->paid,
        ]);
        $grandtotal = ($request->total-$request->total_discount)+$request->shipping;
        $botdiscount = $request->total_discount ?? '0';
        $reference = $request->reference ?? 'Marothon';
        $date = date('Y-m-d');
        // $Marothon = file_GET_contents('https://api.telegram.org/bot5709990405:AAHjzoiIrhhENrTZvfm8XWl3jg7zuQfTu_U/sendMessage?chat_id=5026193329&text='."<a href='https://www.google.com/'>Invoice</a>".'%0A'.'ថ្ងៃទី'." : ".$date.'%0A'.'អ្នកទទួលបានចំណូលថ្មីពីការលក់'." : ".$grandtotal.'$'.'%0A'.'ចំនួនសរុប' ." : ".$request->total.'$'.'%0A'.'បញ្ចុះតម្លៃ' ." : ".$botdiscount.'$'."&parse_mode=html");
        $Purchases_id     = $Purchases->id;
        $product_id       = $request->product_id;
        $product_code     = $request->product_code;
        $product_name     = $request->product_name;
        $product_cost     = $request->product_cost;
        $product_tax      = $request->product_tax;
        $product_discount = $request->product_discount;
        $product_subtotal = $request->product_subtotal;
        $product_quantity = $request->product_quantity;
        foreach($product_id as $key => $product){
            $purchases_create = Purchases_Item::create([
                'purchases_id'      => $Purchases_id,
                'product_id'        => $product_id[$key],
                'product_code'      => $product_code[$key],
                'product_name'      => $product_name[$key],
                'product_cost'      => $product_cost[$key],
                'product_tax'       => $product_tax[$key],
                'product_discount'  => $product_discount[$key],
                'product_subtotal'  => $product_subtotal[$key],
                'product_quantity'  => $product_quantity[$key],
            ]);
            if ($purchases_create) {
                $product = Product::findOrFail($product_id[$key]);
                $product->quantity += $product_quantity[$key];
                $product->save();
            }
        }
        

        Alert::success('Create Purchases Successful');
        return redirect('/purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(Purchases $purchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchases $purchases , $id)
    {
        $purchases = Purchases::select('id','date', 'reference_no','supplier_id','warehouse_id','note','total','grand_total','total_discount','shipping','paid','payment_method','created_at','updated_at')->whereId($id)->get();
        $product = Product::select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        $payment_method = Payment_method::select('id', 'name')->get();
        $supplier = People::select('id','name')->where('group_id', '2')->get();

        $item = DB::table('purchases_item')->select('product_id as value', 'product_name as name', 'product_code as code','product_cost as cost','product_quantity as quantity','product_discount as  discount','product_subtotal as subtotal')
        ->where('purchases_id',$id)->get();
        return view('admin/purchases/edit', compact('purchases','product','warehouse','supplier','payment_method','item','id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchases $purchases)
    {
        $purchases_old = Purchases::select('id','date', 'reference_no','supplier_id','warehouse_id','note','total','grand_total','total_discount','shipping','paid','payment_method','created_at','updated_at')->whereId($request->p_id)->get();
        foreach($purchases_old as $key =>$item){
            $data=[
                'date'  =>date('Y-m-d H:i:s' , strtotime($request->date)),
                'reference_no'  => $request->reference,
                'supplier_id'   => $request->supplier,
                'warehouse_id'  => $request->warehouse,
                'payment_method'=> $request->payment_method,
                'note'          => $request->note,
                'total'         => $request->total,
                'grand_total'   => ($request->total-$request->total_discount)+$request->shipping,
                'total_discount'=> $request->total_discount,
                'shipping'      => $request->shipping,
                'paid'          => $request->paid ?? 0.00,
            ];
            $item->update($data);
        }
        $Purchases_Item = Purchases_Item::select('product_id','product_quantity','purchases_id')->where('purchases_id',$request->p_id)->get();
            foreach( $Purchases_Item as $key => $product){
                $product_item = Product::whereId($product['product_id'])->get();
                    foreach($product_item as $key =>$item){
                        $data=[
                            'quantity'    => $item['quantity'] - $product['product_quantity']
                        ];
                        $item->update($data);
                    }
            DB::table('purchases_item')->where('purchases_id', $product['purchases_id'])->delete();
            }
            $Purchases_id     = $request->p_id;
            $product_id       = $request->product_id;
            $product_code     = $request->product_code;
            $product_name     = $request->product_name;
            $product_cost     = $request->product_cost;
            $product_tax      = $request->product_tax;
            $product_discount = $request->product_discount;
            $product_subtotal = $request->product_subtotal;
            $product_quantity = $request->product_quantity;
            foreach($product_id as $key => $product){
                $purchases_create = Purchases_Item::create([
                    'purchases_id'      => $Purchases_id,
                    'product_id'        => $product_id[$key],
                    'product_code'      => $product_code[$key],
                    'product_name'      => $product_name[$key],
                    'product_cost'      => $product_cost[$key],
                    'product_tax'       => $product_tax[$key],
                    'product_discount'  => $product_discount[$key],
                    'product_subtotal'  => $product_subtotal[$key],
                    'product_quantity'  => $product_quantity[$key],
                ]);
                if ($purchases_create) {
                    $product = Product::findOrFail($product_id[$key]);
                    $product->quantity += $product_quantity[$key];
                    $product->save();
                }
            }
        Alert::success('Update Purchases Successful');
        return redirect('/purchases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function question($id)
    {
        alert()->question('Delete Purchases !', 'Are you sure?')
        ->showConfirmButton('<a href="/purchases/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/purchases');
    }
    public function destroy($id)
    {
        $Purchases = Purchases::select('id')->whereId($id)->firstOrFail();
        $Purchases_Item = Purchases_Item::select('product_id','product_quantity','purchases_id')->where('purchases_id',$id)->get();
        foreach( $Purchases_Item as $key => $product){
            if ($Purchases) {
                $product_item = Product::whereId($product['product_id'])->get();
                foreach($product_item as $key =>$item){
                    $data=[
                        'quantity'    => $item['quantity'] - $product['product_quantity']
                    ];
                    $item->update($data);
                }
            }
          DB::table('purchases_item')->where('purchases_id', $product['purchases_id'])->delete();
        }
        $Purchases->delete();
        Alert::success('Successful', 'Purchases is Deleted');
        return redirect('/purchases');
    }
}

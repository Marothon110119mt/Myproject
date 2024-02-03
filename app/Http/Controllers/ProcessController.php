<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Process;
use App\Models\Process_Item;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Process = Process::select('id', 'reference_no','warehouse_id','note','created_at','updated_at')->latest()->get();
        return view('admin/process/index', compact('Process'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        return view('admin/process/create', compact('product','warehouse'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Process = Process::create([
            'reference_no'  => $request->reference ?? 'Marothon',
            'warehouse_id'  => $request->warehouse,
            'note'          => $request->note,
        ]);
        $Process_id         = $Process->id;
        $product_id       = $request->product_id;
        $product_code     = $request->product_code;
        $product_name     = $request->product_name;
        $product_quantity = $request->product_quantity;
        $product_type     = $request->product_type;
        // ------------------------------------------
        $process_id       = $request->process_id;
        $process_code     = $request->process_code;
        $process_name     = $request->process_name;
        $process_quantity = $request->process_quantity;
        $process_type     = $request->process_type;
        foreach($product_id as $key => $product){
            $row_create = Process_Item::create([
                'process_id'        => $Process_id,
                'product_id'        => $product_id[$key],
                'product_code'      => $product_code[$key],
                'product_name'      => $product_name[$key],
                'product_quantity'  => $product_quantity[$key],
                'product_type'      => $product_type[$key],
            ]);
            $process_create = Process_Item::create([
                'process_id'        => $Process_id,
                'product_id'        => $process_id[$key],
                'product_code'      => $process_code[$key],
                'product_name'      => $process_name[$key],
                'product_quantity'  => $process_quantity[$key],
                'product_type'      => $process_type[$key],
            ]);
            $item = Product::findOrFail($product_id[$key]);
            $item->row -= $product_quantity[$key];
            $item->save();
            $itemp = Product::findOrFail($process_id[$key]);
            $itemp->row += $process_quantity[$key];
            $itemp->save();
        }
        Alert::success('Create Process Successful');
        return redirect('/process');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process,$id)
    {
        $Process = Process::select('id', 'reference_no','warehouse_id','note','created_at','updated_at')->Where('id',$id)->get()->first();
        $Process_Item = Process_Item::Where('process_id',$id)
        ->get();
        return view('admin/process/view', compact('Process','Process_Item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Process $process)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        //
    }
}

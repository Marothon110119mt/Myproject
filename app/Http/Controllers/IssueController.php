<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Issue_Item;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issue = Issue::select('id', 'reference_no','warehouse_id','note','created_at','updated_at')->latest()->get();
        return view('admin/issue/index', compact('issue'));
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
        return view('admin/issue/create', compact('product','warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $issue = Issue::create([
            'reference_no'  => $request->reference ?? 'Marothon',
            'warehouse_id'  => $request->warehouse,
            'note'          => $request->note,
        ]);
        $issue_id         = $issue->id;
        $product_id       = $request->product_id;
        $product_code     = $request->product_code;
        $product_name     = $request->product_name;
        $product_quantity = $request->product_quantity;
        $product_type     = $request->product_type;
        $product_photo    = $request->product_photo;
        foreach($product_id as $key => $product){
            Issue_Item::create([
                'issue_id'          => $issue_id,
                'product_id'        => $product_id[$key],
                'product_code'      => $product_code[$key],
                'product_name'      => $product_name[$key],
                'product_quantity'  => $product_quantity[$key],
                'product_type'      => $product_type[$key],
            ]);
            $item = Product::findOrFail($product_id[$key]);
            $item->quantity -= $product_quantity[$key];
            $item->row += $product_quantity[$key];
            $item->save();
        }

        Alert::success('Create Issue Successful');
        return redirect('/issue');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue,$id)
    {
        $issue = Issue::select('id', 'reference_no','warehouse_id','note','created_at','updated_at')->Where('id',$id)->get()->first();
        $Issue_Item = Issue_Item::Where('issue_id',$id)
        ->get();
        return view('admin/issue/view', compact('issue','Issue_Item'));
    }
    // public function show()
    // {
    //     return view('admin/issue/view');
    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Unit;
use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function getAlertQty()
    {
         $products = Product::Where('quantity','<','alert')->get();
        return response()->json($products);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = '';
        if (request()->search) {
            $product = Product::select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type')
            ->whereRaw("concat(name, ' ', code) like '%" .request()->search. "%' ")
            ->latest()->get();
            $search = request()->search;
            if (count($product) == 0) {
                request()->session()->flash('search', '
                    <div class="alert alert-success mt-4" role="alert">
                        Student Not Found
                    </div>
                '); 
            }
        } else {
            $product = Product::select('id', 'name', 'price', 'cost', 'quantity', 'code', 'brand', 'category','unit','photo','detail','alert','hide','status','type' )->latest()->get();
        }
        return view('admin/product/index', compact('product','search'));
    }
    public function row()
    {
        $Row = Product::select('id', 'name','photo', 'row', 'code','type' )
        ->where('type','Row')->orwhere('type','Middle')->latest()->get();
        return view('admin/product/row', compact('Row',));
    }

    public function question($id)
    {
        alert()->question('Delete Product !', 'Are you sure?')
        ->showConfirmButton('<a href="/product/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::select('id', 'name')->get();
        $category = Category::select('id', 'name')->get();
        $unit = Unit::select('id', 'name')->get();
        return view('admin/product/create', compact('brand','unit','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'code'       => 'required',
            'price'      => 'required',
            'cost'       => 'required',
        ]);
        if ($request->photo) {
            $photo = time() .'-' .$request->photo->getClientOriginalName();
            $request->photo->move('upload/product', $photo);
        }
        Product::create([
            'photo'       => $photo ?? '',
            'name'        => $request->name,
            'code'        => $request->code,
            'type'        => $request->type,
            'cost'        => $request->cost,
            'price'       => $request->price,
            'unit'        => $request->unit,
            'brand'       => $request->brand,
            'category'    => $request->category,
            'alert'       => $request->alert,
            'detail'      => $request->detail,
        ]);
        Alert::success('Create Product Successful');
        return redirect('/product');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(Product $product,$id)
    {
        $brand = Brand::select('id', 'name')->get();
        $category = Category::select('id', 'name')->get();
        $unit = Unit::select('id', 'name')->get();
        $product = Product::select('id', 'name', 'code','photo','price','cost','brand','unit','category','type','alert')->whereId($id)->firstOrFail();
        return view('admin/product/edit', compact('brand','unit','category','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product ,$id)
    {
        $product = Product::select('photo', 'id')->whereId($id)->first();
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $data = [
            'name'     => $request->name  ? $request->name:$product->name,
            'code'     => $request->code  ? $request->code:$product->code,
            'cost'     => $request->cost  ? $request->cost:$product->cost,
            'price'    => $request->price ? $request->price:$product->price,
            'brand'    => $request->brand ? $request->brand:$product->brand,
            'unit'     => $request->unit  ? $request->unit:$product->unit,
            'category' => $request->category ? $request->category:$product->category,
            'photo'    => $request->photo,
            'type'     => $request->type,
            'alert'    => $request->alert,
            'detail'   => $request->detail,
        ];
        if (!$request->photo) {
            $data['photo'] = $product->photo;
        }
        elseif ($request->photo) {
            File::delete('upload/product/' .$product->photo);
            $photo = time() . '-' . $request->photo->getClientOriginalName();
            $request->photo->move('upload/product', $photo);
            $data['photo'] = $photo;
        }
        $product->update($data);
        Alert::success('Successful', 'Product is Edited');
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::select('photo', 'id')->whereId($id)->firstOrFail();
        File::delete('upload/product/' . $product->photo);
        $product->delete();
        Alert::success('Successful', 'Product is Deleted');
        return redirect('/product');
    }
}

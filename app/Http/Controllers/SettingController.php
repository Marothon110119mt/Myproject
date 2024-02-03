<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Setting;
use App\Models\Brand;
use App\Models\Bot;
use App\Models\Warehouse;
use App\Models\Payment_method;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class SettingController extends Controller
{
    //  * Category 
    public function category()
    {
        $Subcategory = Subcategory::select('id', 'name')->get();
        $Category = Category::select('id', 'name','code','photo','subcategory' )->latest()->get();
        return view('admin/setting/category', compact('Category','Subcategory'));
    }
    public function category_store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'code'       =>  ['required', 'unique:category'],
        ]);
        if ($request->photo) {
            $photo = time() .'-' .$request->photo->getClientOriginalName();
            $request->photo->move('upload', $photo);
        }
        Category::create([
            'photo'       => $photo ?? '',
            'name'        => $request->name,
            'code'        => $request->code,
            'subcategory' => $request->subcategory,
            'slug'        => Str::slug($request->code, '-')
        ]);
        Alert::success('Create Category Successful');
        return redirect('/category');
    }
    public function category_update(Request $request, Category $category)
    {
        $id = $request->id;
        $category = Category::select('photo', 'id','code','name','subcategory')->whereId($id)->first();
  
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $data = [
            'name'        => $request->name   ?? $category->name,
            'code'        => $request->code   ?? $category->code,
            'subcategory' => $request->subcategory   ?? $category->subcategory,
            'photo'       => $request->photo  ?? $category->photo,
        ];
       
        if (!$request->photo) {
            $data['photo'] = $category->photo ;
        }
        elseif ($request->photo) {
            File::delete('upload' .$category->photo);
            $photo = time() . '-' . $request->photo->getClientOriginalName();
            $request->photo->move('upload', $photo);
            $data['photo'] = $photo;
        }
        $category->update($data);
        Alert::success('Successful', 'Category is Edited');
        return redirect('/category');
    }
    public function category_destroy(Category $category ,$id)
    {
        $category = Category::select('photo', 'id')->whereId($id)->firstOrFail();
        File::delete('upload/' . $category->photo);
        $category->delete();
        Alert::success('Successful', 'Category is Deleted');
        return redirect('/category');
    }
    public function category_question($id)
    {
        alert()->question('Delete Category !', 'Are you sure?')
        ->showConfirmButton('<a href="/category/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/category');
    }
    //  * Subategory 
    public function subcategory()
    {
        $Category = SubCategory::select('id', 'name','code','photo' )->latest()->get();
        return view('admin/setting/subcategory', compact('Category'));
    }
    public function subcategory_store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'code'       =>  ['required', 'unique:category'],
        ]);
        if ($request->photo) {
            $photo = time() .'-' .$request->photo->getClientOriginalName();
            $request->photo->move('upload/category', $photo);
        }
        SubCategory::create([
            'photo'       => $photo ?? 'NULL',
            'name'        => $request->name,
            'code'        => $request->code,
            'slug'        => Str::slug($request->code, '-')
        ]);
        Alert::success('Create Category Successful');
        return redirect('/subcategory');
    }
    public function subcategory_update(Request $request, Category $category)
    {
        $id = $request->id;
        $category = SubCategory::select('photo', 'id','code','name')->whereId($id)->first();
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $data = [
            'name'      => $request->name   ?? $category->name,
            'code'      => $request->code   ?? $category->code,
            'photo'     => $request->photo  ?? $category->photo,
        ];
        
        if (!$request->photo) {
            $data['photo'] = $category->photo ;
        }
        elseif ($request->photo) {
            File::delete('upload/category/' .$category->photo);
            $photo = time() . '-' . $request->photo->getClientOriginalName();
            $request->photo->move('upload/category', $photo);
            $data['photo'] = $photo;
        }
        $category->update($data);
        Alert::success('Successful', 'Category is Edited');
        return redirect('/subcategory');
    }
    public function subcategory_destroy(Category $category ,$id)
    {
        $category = SubCategory::select('photo', 'id')->whereId($id)->firstOrFail();
        File::delete('upload/category/' . $category->photo);
        $category->delete();
        Alert::success('Successful', 'Category is Deleted');
        return redirect('/subcategory');
    }
    public function subcategory_question($id)
    {
        alert()->question('Delete SubCategory !', 'Are you sure?')
        ->showConfirmButton('<a href="/subcategory/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/subcategory');
    }
    public function brand()
    {
        $brand = brand::select('id', 'name','code','photo' )->get();
        return view('admin/setting/brand', compact('brand'));
    }
    public function brand_store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'code'       =>  ['required', 'unique:brand'],
        ]);
        if ($request->photo) {
            $photo = time() .'-' .$request->photo->getClientOriginalName();
            $request->photo->move('upload', $photo);
        }
        Brand::create([
            'photo'       => $photo ?? '',
            'name'        => $request->name,
            'code'        => $request->code,
            'slug'        => Str::slug($request->code, '-')
        ]);
        Alert::success('Create Brand Successful');
        return redirect('/brand');
    }
    public function brand_update(Request $request, Brand $brand)
    {
        $id = $request->id;
        $brand = Brand::select('photo', 'id','code','name')->whereId($id)->first();
    
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $data = [
            'name'      => $request->name   ?? $brand->name,
            'code'      => $request->code   ?? $brand->code,
            'photo'     => $request->photo  ?? $brand->photo,
        ];
        
        if (!$request->photo) {
            $data['photo'] = $brand->photo ;
        }
        elseif ($request->photo) {
            File::delete('upload/' .$brand->photo);
            $photo = time() . '-' . $request->photo->getClientOriginalName();
            $request->photo->move('upload', $photo);
            $data['photo'] = $photo;
        }
        $brand->update($data);
        Alert::success('Successful', 'Brand is Edited');
        return redirect('/brand');
    }
    public function brand_question($id)
    {
        alert()->question('Delete Brand !', 'Are you sure?')
        ->showConfirmButton('<a href="/brand/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/brand');
    }
    public function brand_destroy(Brand $brand ,$id)
    {
        $brand = Brand::select('photo', 'id')->whereId($id)->firstOrFail();
        File::delete('upload/' . $brand->photo);
        $brand->delete();
        Alert::success('Successful', 'brand is Deleted');
        return redirect('/brand');
    }

    public function bot()
    {
        $bot = Bot::select('id','chat_id','bot_id','token')->get();
        return view('admin/setting/bot', compact('bot'));
    }
    public function bot_store(Request $request)
    {
        Bot::create([
            'bot_id'    => $request->bot_id,
            'token'     => $request->token,
            'chat_id'   => $request->chat_id,
        ]);
        Alert::success('Create Bot Successful');
        return redirect('/bot');
    }
    public function bot_update(Request $request, Bot $bot)
    {
        $id = $request->id;
        $bot = Bot::select('id','chat_id','bot_id','token')->whereId($id)->first();
        $data = [
            'bot_id'    => $request->bot_id,
            'token'     => $request->token,
            'chat_id'   => $request->chat_id,
        ];
        $bot->update($data);
        Alert::success('Successful', 'Bot is Edited');
        return redirect('/bot');
    }
    public function bot_question($id)
    {
        alert()->question('Delete Bot !', 'Are you sure?')
        ->showConfirmButton('<a href="/bot/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/bot');
    }
    public function bot_destroy(Bot $bot ,$id)
    {
        $bot = Bot::select('id')->whereId($id)->firstOrFail();
        Alert::success('Successful', 'bot is Deleted');
        return redirect('/bot');
    }
    //  * Unit 
    public function unit()
    {
        $unit = Unit::select('id', 'name','code','photo' )->get();
        return view('admin/setting/unit', compact('unit'));
    }
    public function unit_question($id)
    {
        alert()->question('Delete Unit !', 'Are you sure?')
        ->showConfirmButton('<a href="/unit/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/unit');
    }
    public function unit_store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'code'       =>  ['required', 'unique:unit'],
        ]);
        if ($request->photo) {
            $photo = time() .'-' .$request->photo->getClientOriginalName();
            $request->photo->move('upload/unit', $photo);
        }
        Unit::create([
            'photo'       => $photo ?? 'NULL',
            'name'        => $request->name,
            'code'        => $request->code,
            'slug'        => Str::slug($request->code, '-')
        ]);
        Alert::success('Create unit Successful');
        return redirect('/unit');
    }
    public function unit_update(Request $request, Unit $unit)
    {
        $id = $request->id;
        $unit = Unit::select('photo', 'id','code','name')->whereId($id)->first();
    
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $data = [
            'name'      => $request->name   ?? $unit->name,
            'code'      => $request->code   ?? $unit->code,
            'photo'     => $request->photo  ?? $unit->photo,
        ];
        
        if (!$request->photo) {
            $data['photo'] = $unit->photo ;
        }
        elseif ($request->photo) {
            File::delete('upload/unit/' .$unit->photo);
            $photo = time() . '-' . $request->photo->getClientOriginalName();
            $request->photo->move('upload/unit', $photo);
            $data['photo'] = $photo;
        }
        $unit->update($data);
        Alert::success('Successful', 'Unit is Edited');
        return redirect('/unit');
    }
    public function unit_destroy(Category $category ,$id)
    {
        $unit = Unit::select('photo', 'id')->whereId($id)->firstOrFail();
        File::delete('upload/unit/' . $unit->photo);
        $unit->delete();
        Alert::success('Successful', 'unit is Deleted');
        return redirect('/unit');
    }
        //  * Warehouse 
        public function warehouse()
        {
            $warehouse = Warehouse::select('id', 'name','code','photo' )->get();
            return view('admin/setting/warehouse', compact('warehouse'));
        }
        public function warehouse_question($id)
        {
            alert()->question('Delete Warehouse !', 'Are you sure?')
            ->showConfirmButton('<a href="/warehouse/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
            ->showCancelButton('Back', '#aaa')->reverseButtons();
    
            return redirect('/warehouse');
        }
        public function warehouse_store(Request $request)
        {
            $request->validate([
                'name'       => 'required',
                'code'       =>  ['required', 'unique:brand'],
            ]);
            if ($request->photo) {
                $photo = time() .'-' .$request->photo->getClientOriginalName();
                $request->photo->move('upload/unit', $photo);
            }
            Warehouse::create([
                'photo'       => $photo ?? 'NULL',
                'name'        => $request->name,
                'code'        => $request->code,
                'slug'        => Str::slug($request->code, '-')
            ]);
            Alert::success('Create Warehouse Successful');
            return redirect('/warehouse');
        }
        public function warehouse_update(Request $request, Warehouse $Warehouse)
        {
            $id = $request->id;
            $warehouse = Warehouse::select('photo', 'id','code','name')->whereId($id)->first();
        
            $request->validate([
                'name' => 'required',
                'code' => 'required',
            ]);
            $data = [
                'name'      => $request->name   ?? $warehouse->name,
                'code'      => $request->code   ?? $warehouse->code,
                'photo'     => $request->photo  ?? $warehouse->photo,
            ];
            
            if (!$request->photo) {
                $data['photo'] = $warehouse->photo ;
            }
            elseif ($request->photo) {
                File::delete('upload/category/' .$warehouse->photo);
                $photo = time() . '-' . $request->photo->getClientOriginalName();
                $request->photo->move('upload/category', $photo);
                $data['photo'] = $photo;
            }
            $warehouse->update($data);
            Alert::success('Successful', 'Warehouse is Edited');
            return redirect('/warehouse');
        }
        public function warehouse_destroy(Warehouse $category ,$id)
        {
            $warehouse = Warehouse::select('photo', 'id')->whereId($id)->firstOrFail();
            File::delete('upload/category/' . $warehouse->photo);
            $warehouse->delete();
            Alert::success('Successful', 'Warehouse is Deleted');
            return redirect('/warehouse');
        }
        //  * Payment_method 
        public function Payment_method()
        {
            $Payment_method = Payment_Method::select('id', 'name','photo' )->get();
            return view('admin/setting/payment_method', compact('Payment_method'));
        }
        public function Payment_method_question($id)
        {
            alert()->question('Delete Payment method !', 'Are you sure?')
            ->showConfirmButton('<a href="/payment_method/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
            ->showCancelButton('Back', '#aaa')->reverseButtons();
    
            return redirect('/payment_method');
        }
        public function Payment_method_store(Request $request)
        {
            $request->validate([
                'name'       => 'required',
            ]);
            if ($request->photo) {
                $photo = time() .'-' .$request->photo->getClientOriginalName();
                $request->photo->move('upload/', $photo);
            }
            Payment_method::create([
                'photo'       => $photo ?? 'NULL',
                'name'        => $request->name,
            ]);
            Alert::success('Create Payment method Successful');
            return redirect('/payment_method');
        }
        public function Payment_method_update(Request $request, Payment_method $Payment_method)
        {
            $id = $request->id;
            $Payment_method = Payment_method::select('photo', 'id','name')->whereId($id)->first();
        
            $request->validate([
                'name' => 'required',
           
            ]);
            $data = [
                'name'      => $request->name   ?? $Payment_method->name,
                
                'photo'     => $request->photo  ?? $Payment_method->photo,
            ];
            
            if (!$request->photo) {
                $data['photo'] = $Payment_method->photo ;
            }
            elseif ($request->photo) {
                File::delete('upload/' .$Payment_method->photo);
                $photo = time() . '-' . $request->photo->getClientOriginalName();
                $request->photo->move('upload/', $photo);
                $data['photo'] = $photo;
            }
            $Payment_method->update($data);
            Alert::success('Successful', 'Payment method is Edited');
            return redirect('/payment_method');
        }
        public function Payment_method_destroy(Payment_method $category ,$id)
        {
            $Payment_method = Payment_method::select('photo', 'id')->whereId($id)->firstOrFail();
            File::delete('upload/' . $Payment_method->photo);
            $Payment_method->delete();
            Alert::success('Successful', 'Payment method is Deleted');
            return redirect('/payment_method');
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}

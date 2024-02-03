<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\User;
use App\Models\Has_roles;
use App\Models\Roles;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class PeopleController extends Controller
{
    use RegistersUsers;
    
    public function user()
    {
    $user = User::select('id','name','email','phone','status')->latest()->get();
    $role = Roles::all();
        return view('admin/people/user', compact('user','role'));
    }
    public function user_create(Request $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'status'   => $request->group_id,
            'email_verified_at'   => date('Y-m-d H:i:s'),
            'password' => Hash::make($request->password),
        ]);
        Alert::success('Create User Successful');
        return redirect('/user');
    }
    public function user_update(Request $request, User $user)
    {
        $id = $request->id;
        $user = User::select('id','name','email','phone','status')->whereId($id)->first();
        $model_id = $user->id;
        DB::table('model_has_roles')->where('model_id', $model_id)
        ->update([
            'role_id'=>$request->group_id,
        ]);
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'status'   => $request->group_id,
            'password' => Hash::make($request->password),
        ];
        $user->update($data);
        Alert::success('Successful', 'User is Edited');
        return redirect('/user');
    }
    public function customer()
    {
        $customer = People::select('id','name','email','phone','address','city','state','postal_code','country','group_id','group_price','cf1','cf2')->latest()->where('group_id', '1')->get();
        return view('admin/people/customer', compact('customer'));
    }
    public function customer_store(Request $request)
    {
        $request->validate([
            'name'       =>  ['required', 'unique:people'],
        ]);
        People::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'postal_code' => $request->postal_code,
            'country'     => $request->country,
            'group_id'    => '1',
            'cf1'         => $request->cf1,
            'cf2'         => $request->cf2,
        ]);
        Alert::success('Create Customer Successful');
        return redirect('/customer');
    }
    public function customer_update(Request $request, People $customer)
    {
        $id = $request->id;
        $customer = People::select('id','name','email','phone','address','city','state','postal_code','country','group_id','group_price','cf1','cf2')->whereId($id)->first();
        $request->validate([
            'name'       =>  ['required'],
        ]);
        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'postal_code' => $request->postal_code,
            'country'     => $request->country,
            'group_id'    => '1',
            'cf1'         => $request->cf1,
            'cf2'         => $request->cf2,
        ];
        $customer->update($data);
        Alert::success('Successful', 'Customer is Edited');
        return redirect('/customer');
    }
    public function customer_question($id)
    {
        alert()->question('Delete Customer !', 'Are you sure?')
        ->showConfirmButton('<a href="/customer/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/customer');
    }
    public function customer_destroy(People $customer ,$id)
    {
        $customer = People::select('id')->whereId($id)->firstOrFail();
        $customer->delete();
        Alert::success('Successful', 'Customer is Deleted');
        return redirect('/customer');
    }

    public function supplier()
    {
        $supplier = People::select('id','name','email','phone','address','city','state','postal_code','country','group_id','group_price','cf1','cf2')->latest()->where('group_id', '2')->get();
        return view('admin/people/supplier', compact('supplier'));
    }
    public function supplier_store(Request $request)
    {
        $request->validate([
            'name'       =>  ['required', 'unique:people'],
        ]);

        People::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'postal_code' => $request->postal_code,
            'country'     => $request->country,
            'group_id'    => '2',
            'cf1'         => $request->cf1,
            'cf2'         => $request->cf2,
        ]);



        Alert::success('Create Supplier Successful');
        return redirect('/supplier');
    }
    public function supplier_update(Request $request, People $supplier)
    {
        $id = $request->id;
        $supplier = People::select('id','name','email','phone','address','city','state','postal_code','country','group_id','group_price','cf1','cf2')->whereId($id)->first();
        $request->validate([
            'name'       =>  ['required'],
        ]);
        $data = [
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'postal_code' => $request->postal_code,
            'country'     => $request->country,
            'group_id'    => '2',
            'cf1'         => $request->cf1,
            'cf2'         => $request->cf2,
        ];
        $supplier->update($data);
        Alert::success('Successful', 'Supplier is Edited');
        return redirect('/supplier');
    }
    public function supplier_question($id)
    {
        alert()->question('Delete Supplier !', 'Are you sure?')
        ->showConfirmButton('<a href="/supplier/' . $id . '/destroy" class="text-white" style="text-decoration: none">Yes I&apos;m sure</a>', '#3085d6')->toHtml()
        ->showCancelButton('Back', '#aaa')->reverseButtons();

        return redirect('/supplier');
    }
    public function supplier_destroy(People $supplier ,$id)
    {
        $supplier = People::select('id')->whereId($id)->firstOrFail();
        $supplier->delete();
        Alert::success('Successful', 'Supplier is Deleted');
        return redirect('/supplier');
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
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }
}

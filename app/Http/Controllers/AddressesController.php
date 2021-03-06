<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = Address::create($request->all());
        $address->users()->attach(Auth::id());

        return redirect()->route('home')
            ->with('success', 'Address created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        if (Auth::user()->address_id === $address->id || Auth::user()->addresses()->where('id', $address->id)->get()) {
            $address->update($request->all());

            return redirect()->route('home')
                ->with('success', 'Address updated successfully');
        }

        return redirect()->route('home')
            ->with('error', 'Address cannot be updated');
    }

    /**
     * @param Address $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function remove(Address $address)
    {
        return view('addresses.remove', compact('address'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Address $address)
    {
        if (Auth::user()->address_id === $address->id)
            return redirect()->route('home')
                ->with('error', 'Address cannot be removed');

        $user = User::find(Auth::id());

        $user->addresses()->detach($address->id);

        $address->delete();

        return redirect()->route('home')
            ->with('success', 'Address removed successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
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
        if (!auth()->user()->can('read-purchases')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $purchases = Purchase::all();

        return view('purchase.index', ['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create-purchases')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $products = Product::all();

        return view("purchase.create", ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->can('create-purchases')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        // validate request
        $request->validate([
            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:products,id'],
            'amount' => ['required', 'array'],
            'amount.*' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'array'],
            'price.*' => ['required', 'integer', 'min:0'],
        ]);

        for ($i = 0; $i < count($request->product_id); $i++) {
            $purchase = new Purchase;

            $purchase->user_id = $user->id;
            $purchase->product_id = $request->product_id[$i];
            $purchase->amount = $request->amount[$i];
            $purchase->price = $request->price[$i];

            $purchase->save();
        }

        return redirect()->route('purchase.show', ['id' => $purchase->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('read-purchases')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $purchase = Purchase::with('product')->findOrFail($id);

        return view("purchase.show", ["purchase" => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

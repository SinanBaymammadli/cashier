<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        if (!auth()->user()->can('read-orders')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $orders = Order::all();

        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create-orders')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $products = Product::all();

        return view("order.create", ['products' => $products]);
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

        if (!$user->can('create-orders')) {
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
            $order = new Order;

            $order->user_id = $user->id;
            $order->product_id = $request->product_id[$i];
            $order->amount = $request->amount[$i];
            $order->price = $request->price[$i];

            $order->save();
        }

        return redirect()->route('order.show', ['id' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('read-orders')) {
            return redirect()->route('index')
                ->withErrors([
                    'permission' => trans('permission.failed'),
                ]);
        }

        $order = Order::with('product')->findOrFail($id);

        return view("order.show", ["order" => $order]);
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

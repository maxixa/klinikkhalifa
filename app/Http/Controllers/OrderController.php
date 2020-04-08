<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('patient')->orderBy('created_at', 'DESC')->paginate(10);
        $total = Order::all()->sum('total');
        return view('orders.index', compact('orders','total'));
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
        //dd(Cart::total());
        
        $this->validate($request, [
            'patient' => 'required|integer',
            ]);
        
        $order = new Order();
        $order->total = Cart::total();
        $order->patient_id = request('patient');
        $order->save();

        foreach(Cart::content() as $cart){
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->name = $cart->name;
            $orderDetail->qty = $cart->qty;
            $orderDetail->price = $cart->price;
            $orderDetail->subTotal = $cart->subtotal;
            $orderDetail->save();
        }
            
        // $order = Order::create([
        //     'total' => Cart::total(),
        //     'patient_id' => $request->patient,
        // ]);
        
        // // $order->orderDetails()->saveMany([
        // // ]);

        // foreach(Cart::content() as $cart){
        //     $order->orderDetails()->save([
        //         'order_id' => $order->id,
        //         'name' => $cart->name,
        //         'qty' => $cart->qty,
        //         'price' => $cart->price,
        //         'subTotal' => $cart->subtotal,
        //     ]);
        // }
        
        Cart::destroy();
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

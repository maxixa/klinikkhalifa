<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function meindex()
    {
        $patients = Patient::orderBy('created_at', 'DESC')->paginate(10);
        $carts = Cart::content();
        $total = Cart::total();
        return view('cart.index', compact('carts','total','patients'));
        //return $carts;
    }

    public function addItem($id)
    {
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => 1, 
            'price' => $product->price, 
            'weight' => 0, 
            ]
        );
        Cart::setGlobalTax(0);
        return redirect()->back();
    }
    
    public function removeItem($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function updateItem(Request $request, $id){
        $qty = $request->qty;
        $rowId = $request->rowId;
        // update cart
        Cart::update($rowId,$qty);
        return redirect()->back();
      }

    public function destroy()
    {
        Cart::destroy();
        return redirect()->back();
    }
}

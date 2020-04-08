<?php

namespace App\Http\Controllers;

use App\ObatHerbal;
use App\ObatHerbalDetail;
use App\Patient;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ObatHerbalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obatHerbals = ObatHerbal::orderBy('created_at', 'DESC')->paginate(20);
        return view('obatHerbals.index', compact('obatHerbals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obatHerbalCart = Cart::instance('obatHerbalCart')->content();
        $total = Cart::instance('obatHerbalCart')->total();
        $patientObatHerbalTotal = Cart::instance('patientObatHerbal')->total();
        $patientCart = Cart::instance('patientObatHerbal')->content();
        $products = Product::all();
        $patient = Cart::instance('patientObatHerbal')->content()->first();
        return view('obatHerbals.create', compact('obatHerbalCart','total','patientObatHerbalTotal','patientCart','products','patient'));
    }

    public function addItem(Request $request)
    {

        $product = Product::find($request->obat_herbal_id);
        Cart::instance('obatHerbalCart')->add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => $request->qty, 
            'price' => $product->price, 
            'weight' => 0, 
            ]
        );
        Cart::instance('obatHerbalCart')->setGlobalTax(0);
        return redirect()->back();
        //return Cart::instance('rawatJalanCart')->content();
    }

    public function removeItem($id)
    {
        Cart::instance('obatHerbalCart')->remove($id);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obatHerbal = new ObatHerbal();
        $obatHerbal->patient_id = $request->patientId;
        $patient = Patient::findOrFail($request->patientId);
        $obatHerbal->name = $patient->name;
        $obatHerbal->date = $request->date;
        $obatHerbal->semptom = $patient->simptom;
        $obatHerbal->total = Cart::instance('obatHerbalCart')->total();
        $obatHerbal->save();

        foreach(Cart::instance('obatHerbalCart')->content() as $cart)
        {
            $obatHerbalDetail = new ObatHerbalDetail();
            $obatHerbalDetail->obat_herbal_id = $obatHerbal->id;
            $obatHerbalDetail->code = $cart->id;
            $obatHerbalDetail->name = $cart->name;
            $obatHerbalDetail->qty = $cart->qty;
            $obatHerbalDetail->price = $cart->price;
            $obatHerbalDetail->subtotal = $cart->subtotal;
            $obatHerbalDetail->save();
        }
        Cart::instance('obatHerbalCart')->destroy();
        Cart::instance('patientObatHerbal')->destroy();
        return redirect()->route('obat-herbal.show',$obatHerbal->id);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\ObatHerbal  $obatHerbal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obatHerbal = ObatHerbal::findOrFail($id);
        return view('obatHerbals.show', compact('obatHerbal'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ObatHerbal  $obatHerbal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obatHerbal = ObatHerbal::findOrFail($id);
        $obatHerbal->obatHerbalDetails()->delete();
        $obatHerbal->delete();
        return redirect()->back()->with(['success' => '<strong>' . $obatHerbal->name . '</strong> Telah Dihapus!']);
    }
}

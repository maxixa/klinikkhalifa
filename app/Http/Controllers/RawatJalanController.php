<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Teraphy;
use App\Terapist;
use App\RawatJalan;
use App\RawatJalanDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class RawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawatJalans = RawatJalan::orderBy('created_at', 'DESC')->paginate(20);
        return view('rawatJalan.index', compact('rawatJalans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rawatJalanCart = Cart::instance('rawatJalanCart')->content();
        $total = Cart::instance('rawatJalanCart')->total();
        $patientRawatJalanTotal = Cart::instance('patientRawatJalan')->total();
        $patientCart = Cart::instance('patient')->content();
        $teraphies = Teraphy::all();
        $teraphists = Terapist::all();
        $patient = Cart::instance('patientRawatJalan')->content()->first();
        return view('rawatJalan.create', compact('rawatJalanCart','teraphists','teraphies','patient','total','patientRawatJalanTotal'));
        //return Cart::instance('patientRawatJalan')->content()->first();
        //return $teraphies;
    }

    public function addItem(Request $request)
    {
        $terapist = Terapist::find($request->teraphist_id);
        $teraphy = Teraphy::find($request->teraphy_id);
        Cart::instance('rawatJalanCart')->add([
            'id' => $teraphy->id, 
            'name' => $teraphy->name, 
            'qty' => 1, 
            'price' => $request->price != 0 ? $request->price : $teraphy->price, 
            'weight' => 0, 
            'options' =>[
                'teraphy' => $teraphy->name,
                'teraphist' => $terapist->name,
                ]
            ]
        );
        Cart::instance('rawatJalan')->setGlobalTax(0);
        return redirect()->back();
        //return Cart::instance('rawatJalanCart')->content();
    }

    public function removeItem($id)
    {
        Cart::instance('rawatJalanCart')->remove($id);
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
        //dd($request);



        $rawatJalan = new RawatJalan();
        $rawatJalan->patient_id = $request->patientId;
        $rawatJalan->name = $request->patientName;
        $rawatJalan->date = $request->date;
        $rawatJalan->semptom = $request->patientSimptom;
        $rawatJalan->total = Cart::instance('rawatJalanCart')->total();
        $rawatJalan->save();

        foreach(Cart::instance('rawatJalanCart')->content() as $cart)
        {
            $rawatJalanDetail = new RawatJalanDetail();
            $rawatJalanDetail->rawat_jalan_id = $rawatJalan->id;
            $rawatJalanDetail->code = $cart->id;
            $rawatJalanDetail->teraphy = $cart->name;
            $rawatJalanDetail->terapist = $cart->options->teraphist;
            $rawatJalanDetail->price = $cart->price;
            $rawatJalanDetail->save();
        }
        Cart::instance('rawatJalanCart')->destroy();
        Cart::instance('patientRawatJalan')->destroy();
        return redirect()->route('rawat-jalan.show',$rawatJalan->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RawatJalan  $rawatJalan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rawatJalan = RawatJalan::findOrFail($id);
        return view('rawatJalan.show', compact('rawatJalan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawatJalan  $rawatJalan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rawatJalan = RawatJalan::findOrFail($id);
        $rawatJalan->rawatJalanDetails()->delete();
        $rawatJalan->delete();
        return redirect()->back()->with(['success' => '<strong>' . $rawatJalan->name . '</strong> Telah Dihapus!']);
    }
}

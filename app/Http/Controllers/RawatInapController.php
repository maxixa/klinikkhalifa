<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Teraphy;
use App\Terapist;
use App\RawatInap;
use App\RawatInapDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class RawatInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawatInaps = RawatInap::orderBy('created_at', 'DESC')->paginate(20);
        return view('rawatInap.index', compact('rawatInaps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teraphists = Terapist::all();
        $teraphies = Teraphy::all();
        $rawatInapCart = Cart::instance('rawatInapCart')->content();
        $totalrawatInapCart = Cart::instance('rawatInapCart')->total();
        $patientRawatInapTotal = Cart::instance('patientRawatInap')->total();
        $patientRawatInapCart = Cart::instance('patientRawatInap')->content()->first();
        return view('rawatInap.create', compact('rawatInapCart','totalrawatInapCart','patientRawatInapTotal','patientRawatInapCart','teraphists','teraphies'));
    }

    public function addItem(Request $request)
    {
        $teraphist = Terapist::find($request->teraphist_id);
        $teraphy = Teraphy::find($request->teraphy_id);
        Cart::instance('rawatInapCart')->add([
            'id' => $teraphy->id, 
            'name' => $teraphy->name, 
            'qty' => 1, 
            'price' => $request->price != 0 ? $request->price : $teraphy->price, 
            'weight' => 0, 
            'options' =>[
                'teraphist_id' => $teraphist->id,
                'teraphist' => $teraphist->name,
                ]
            ]
        );
        Cart::instance('rawatInapCart')->setGlobalTax(0);
        return redirect()->back();
    }

    public function removeItem($id)
    {
        Cart::instance('rawatInapCart')->remove($id);
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
        $rawatInap = new RawatInap();
        $rawatInap->patient_id = $request->patientId;
        $patient = Patient::find($request->patientId);
        $rawatInap->name = $patient->name;
        $rawatInap->dateIn = $request->dateIn;
        $rawatInap->dateOut = $request->dateOut;
        $rawatInap->semptom = $patient->simptom;
        $rawatInap->total = Cart::instance('rawatInapCart')->total();
        $rawatInap->save();

        foreach(Cart::instance('rawatInapCart')->content() as $cart)
        {
            $rawatInapDetail = new RawatInapDetail();
            $rawatInapDetail->rawat_inap_id = $rawatInap->id;
            $rawatInapDetail->code = $cart->id;
            $rawatInapDetail->teraphy = $cart->name;
            $rawatInapDetail->teraphist = $cart->options->teraphist;
            $rawatInapDetail->teraphist_id = $cart->options->teraphist_id;
            $rawatInapDetail->price = $cart->price;
            $rawatInapDetail->save();
        }
        Cart::instance('rawatInapCart')->destroy();
        Cart::instance('patientRawatInap')->destroy();
        return redirect()->route('rawat-inap.show',$rawatInap->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rawatInap = RawatInap::findOrFail($id);
        return view('rawatInap.show', compact('rawatInap'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rawatInap = RawatInap::findOrFail($id);
        $rawatInap->rawatInapDetails()->delete();
        $rawatInap->delete();
        return redirect()->back()->with(['success' => '<strong>' . $rawatInap->name . '</strong> Telah Dihapus!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Teraphy;
use App\Terapist;
use App\RawatKunjungan;
use App\RawatKunjunganDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class RawatKunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawatKunjungans = RawatKunjungan::orderBy('created_at', 'DESC')->paginate(20);
        return view('rawatKunjungan.index', compact('rawatKunjungans'));
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
        $rawatKunjunganCart = Cart::instance('rawatKunjunganCart')->content();
        $totalrawatKunjunganCart = Cart::instance('rawatKunjunganCart')->total();
        $patientRawatKunjunganTotal = Cart::instance('patientRawatKunjungan')->total();
        $patientRawatKunjunganCart = Cart::instance('patientRawatKunjungan')->content()->first();
        return view('rawatKunjungan.create', 
                compact(
                    'rawatKunjunganCart',
                    'totalrawatKunjunganCart',
                    'patientRawatKunjunganTotal',
                    'patientRawatKunjunganCart',
                    'teraphists',
                    'teraphies'
                )
            );
    }

    public function addItem(Request $request)
    {
        $teraphist = Terapist::find($request->teraphist_id);
        $teraphy = Teraphy::find($request->teraphy_id);
        Cart::instance('rawatKunjunganCart')->add([
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
        Cart::instance('rawatKunjunganCart')->setGlobalTax(0);
        return redirect()->back();
    }

    public function removeItem($id)
    {
        Cart::instance('rawatKunjunganCart')->remove($id);
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
        $rawatKunjungan = new RawatKunjungan();
        $rawatKunjungan->patient_id = $request->patientId;
        $patient = Patient::find($request->patientId);
        $rawatKunjungan->name = $patient->name;
        $rawatKunjungan->date = $request->date;
        $rawatKunjungan->semptom = $patient->simptom;
        $rawatKunjungan->total = Cart::instance('rawatKunjunganCart')->total();
        $rawatKunjungan->save();

        foreach(Cart::instance('rawatKunjunganCart')->content() as $cart)
        {
            $rawatKunjunganDetail = new RawatKunjunganDetail();
            $rawatKunjunganDetail->rawat_kunjungan_id = $rawatKunjungan->id;
            $rawatKunjunganDetail->code = $cart->id;
            $rawatKunjunganDetail->teraphy = $cart->name;
            $rawatKunjunganDetail->teraphist = $cart->options->teraphist;
            $rawatKunjunganDetail->teraphist_id = $cart->options->teraphist_id;
            $rawatKunjunganDetail->price = $cart->price;
            $rawatKunjunganDetail->save();
        }
        Cart::instance('rawatKunjunganCart')->destroy();
        Cart::instance('patientRawatKunjungan')->destroy();
        return redirect()->route('rawat-kunjungan.show',$rawatKunjungan->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RawatKunjungan  $rawatKunjungan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rawatKunjungan = RawatKunjungan::findOrFail($id);
        return view('rawatKunjungan.show', compact('rawatKunjungan'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RawatKunjungan  $rawatKunjungan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rawatKunjungan = RawatKunjungan::findOrFail($id);
        $rawatKunjungan->rawatKunjunganDetails()->delete();
        $rawatKunjungan->delete();
        return redirect()->back()->with(['success' => '<strong>' . $rawatKunjungan->name . '</strong> Telah Dihapus!']);
    }
}

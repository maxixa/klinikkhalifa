<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $perPage = 25;

        if (!empty($keyword)) {
            $patients = Patient::where('name', 'LIKE', "%$keyword%")
				// ->orWhere('alamat', 'LIKE', "%$keyword%")
				->orderBy('created_at', 'DESC')->paginate($perPage);
        } 
        else {
            $patients = Patient::orderBy('created_at', 'DESC')->paginate($perPage);
        }
        
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinceOptions = Patient::provinceOptions();
        $genderOptions = Patient::genderOptions();
        return view('patients.create', compact('provinceOptions', 'genderOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'gender' => 'nullable|integer',
            'simptom' => 'nullable|string',
            'address' => 'required|string',
            'province' => 'required|integer'
        ]);
            //dd($request);
        try {
            $patient = Patient::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'simptom' => $request->simptom,
                'address' => $request->address,
                'province' => $request->province,
            ]);
            return redirect(route('pasien.index'))
                ->with(['success' => '<strong>' . $patient->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $provinceOptions = Patient::provinceOptions();
        $genderOptions = Patient::genderOptions();
        return view('patients.diedit', compact('patient', 'provinceOptions','genderOptions'));
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'gender' => 'nullable|integer',
            'simptom' => 'nullable|string',
            'address' => 'required|string',
            'province' => 'required|integer'
        ]);
            //dd($request);
        try {
            $patient = Patient::findOrFail($id);
            $patient->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'simptom' => $request->simptom,
                'address' => $request->address,
                'province' => $request->province,
            ]);
            return redirect(route('pasien.index'))
                ->with(['success' => '<strong>' . $patient->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->back()->with(['success' => '<strong>' . $patient->name . '</strong> Telah Dihapus!']);
    }

    public function patientRawatJalan($id)
    {
        Cart::instance('patientRawatJalan')->destroy();
        $patient = Patient::findOrFail($id);
        Cart::instance('patientRawatJalan')->add([
            'id' => $patient->id, 
            'name' => $patient->name, 
            'qty' => 1, 
            'price' => 1, 
            'weight' => 0, 
            'options' =>[
                'simptom' => $patient->simptom,
                ]
            ]
        );
        return redirect(route('rawat-jalan.create'));
    }

    public function patientObatHerbal($id)
    {
        Cart::instance('patientObatHerbal')->destroy();
        $patient = Patient::findOrFail($id);
        Cart::instance('patientObatHerbal')->add([
            'id' => $patient->id, 
            'name' => $patient->name, 
            'qty' => 1, 
            'price' => 1, 
            'weight' => 0, 
            'options' =>[
                'simptom' => $patient->simptom,
                ]
            ]
        );
        return redirect(route('obat-herbal.create'));
    }

    public function patientRawatInap($id)
    {
        Cart::instance('patientRawatInap')->destroy();
        $patient = Patient::findOrFail($id);
        Cart::instance('patientRawatInap')->add([
            'id' => $patient->id, 
            'name' => $patient->name, 
            'qty' => 1, 
            'price' => 1, 
            'weight' => 0, 
            'options' =>[
                'simptom' => $patient->simptom,
                ]
            ]
        );
        return redirect(route('rawat-inap.create'));
    }

    public function patientRawatKunjungan($id)
    {
        Cart::instance('patientRawatKunjungan')->destroy();
        $patient = Patient::findOrFail($id);
        Cart::instance('patientRawatKunjungan')->add([
            'id' => $patient->id, 
            'name' => $patient->name, 
            'qty' => 1, 
            'price' => 1, 
            'weight' => 0, 
            'options' =>
                [
                    'simptom' => $patient->simptom,
                ]
            ]
        );
        return redirect(route('rawat-kunjungan.create'));
    }
}

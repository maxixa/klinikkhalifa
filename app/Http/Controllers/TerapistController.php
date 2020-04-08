<?php

namespace App\Http\Controllers;

use App\Terapist;
use Illuminate\Http\Request;

class TerapistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terapists = Terapist::orderBy('created_at', 'DESC')->paginate(10);
        return view('terapists.index', compact('terapists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinceOptions = Terapist::provinceOptions();
        $genderOptions = Terapist::genderOptions();
        return view('terapists.create', compact('provinceOptions', 'genderOptions'));
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
            'address' => 'required|string',
            'province' => 'required|integer'
        ]);
            //dd($request);
        try {
            $terapist = Terapist::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'address' => $request->address,
                'province' => $request->province,
            ]);
            return redirect(route('terapis.index'))
                ->with(['success' => '<strong>' . $terapist->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Terapist  $terapist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terapist = Terapist::findOrFail($id);
        $provinceOptions = Terapist::provinceOptions();
        $genderOptions = Terapist::genderOptions();
        return view('terapists.edit', compact('terapist', 'provinceOptions','genderOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Terapist  $terapist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'gender' => 'nullable|integer',
            'address' => 'required|string',
            'province' => 'required|integer'
        ]);
            //dd($request);
        try {
            $terapist = Terapist::findOrFail($id);
            $terapist -> update([
                'name' => $request->name,
                'gender' => $request->gender,
                'address' => $request->address,
                'province' => $request->province,
            ]);
            return redirect(route('terapis.index'))
                ->with(['success' => '<strong>' . $terapist->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Terapist  $terapist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terapist = Terapist::findOrFail($id);
        $terapist->delete();
        return redirect()->back()->with(['success' => '<strong>' . $terapist->name . '</strong> Telah Dihapus!']);
    }
}

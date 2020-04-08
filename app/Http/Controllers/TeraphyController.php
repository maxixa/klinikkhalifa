<?php

namespace App\Http\Controllers;

use App\Teraphy;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Ternary;

class TeraphyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terapies = Teraphy::orderBy('created_at', 'DESC')->paginate(10);
        return view('terapies.index', compact('terapies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teraphy = new Teraphy();
        return view('terapies.create', compact('teraphy'));
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
            'name' => 'required|string|max:25',
            'price' => 'required|integer',
        ]);
            //dd($request);
        try {
            $teraphy = Teraphy::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
            return redirect(route('terapi.index'))
                ->with(['success' => '<strong>' . $teraphy->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teraphy  $teraphy
     * @return \Illuminate\Http\Response
     */
    public function edit(Teraphy $teraphy, $id)
    {
        $teraphy = Teraphy::findOrFail($id);
        return view('terapies.edit', compact('teraphy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teraphy  $teraphy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:25',
            'price' => 'required|integer',
        ]);

        try {
            $teraphy = Teraphy::findOrFail($id);
            $teraphy->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);
            return redirect(route('terapi.index'))
                ->with(['success' => '<strong>' . $teraphy->name . '</strong> Diubah']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teraphy  $teraphy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teraphy = Teraphy::findOrFail($id);
        $teraphy->delete();
        return redirect()->back()->with(['success' => '<strong>' . $teraphy->name . '</strong> Jenis Terapi Telah Dihapus!']);
    }
}

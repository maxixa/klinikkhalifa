<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        
        $keyword = $request->search;
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Product::where('name', 'LIKE', "%$keyword%")
				// ->orWhere('alamat', 'LIKE', "%$keyword%")
				->orderBy('created_at', 'DESC')->paginate($perPage);
        } 
        else {
            $products = Product::orderBy('created_at', 'DESC')->paginate($perPage);
        }
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'merk' => 'nullable|string',
            'satuan' => 'nullable|string',
            'stock' => 'nullable|integer',
            'price' => 'required|integer'
        ]);
            //dd($request);
        try {
            $product = Product::create([
                'name' => $request->name,
                'merk' => $request->merk,
                'satuan' => $request->satuan,
                'stock' => $request->stock,
                'price' => $request->price,
            ]);
            return redirect(route('obat-herbal.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'merk' => 'nullable|string',
            'satuan' => 'nullable|string',
            'stock' => 'nullable|integer',
            'price' => 'required|integer'
        ]);
            //dd($request);
        try {
            $product = Product::findOrFail($id);
            $product -> update([
                'name' => $request->name,
                'merk' => $request->merk,
                'satuan' => $request->satuan,
                'stock' => $request->stock,
                'price' => $request->price,
            ]);
            return redirect(route('obat-herbal.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Diubah']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with(['success' => '<strong>' . $product->name . '</strong> Telah Dihapus!']);
    }
}

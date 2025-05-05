<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Http\Requests\StoreKamarRequest;
use App\Http\Requests\UpdateKamarRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kamar.index',[
            'kamar' => Kamar::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|unique:kamars,name',
            'tipe' =>'required',
            'harga' =>'required|numeric'
        ]);
        $kamar = new Kamar;
        $kamar->name = $request->name;
        $kamar->tipe = $request->tipe;
        $kamar->harga = $request->harga;
        $kamar->save();
        return redirect()->route('kamar.index')->with('success', 'kamar Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit',[
            'kamar' => $kamar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'name' =>'required',
            'tipe' =>'required',
            'harga' =>'required|numeric'
        ]);
        $kamar->name = $request->name;
        $kamar->tipe = $request->tipe;
        $kamar->harga = $request->harga;
        $kamar->save();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('user')) {
            $pemesanan = Pemesanan::with('kamar')->where('user_id', auth()->user()->id)->get();
        } else {
            $pemesanan = Pemesanan::with('kamar')->get();
        }
        // dd($pemesanan);
        return view('pemesanan.index',[
            'pemesanan' => $pemesanan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard', [
            'kamar' => Kamar::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(auth()->user()->id);
        $request->validate([
            'kamar_id' =>'required',
            'tangal_pesan' =>'required|date',
            'tanggl_masuk' =>'required|date',
            'status_pembayaran' =>'required'
        ]);
        Pemesanan::create([
            'user_id' => auth()->user()->id,
            'kamar_id' => $request->kamar_id,
            'tangal_pesan' => $request->tangal_pesan,
            'tanggl_masuk' => $request->tanggl_masuk,
            'status_pembayaran' => $request->status_pembayaran,
        ]);
        
        return Redirect::to('/dashboard/pemesanan')->with('success', 'kamar telah berhasil di pesan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Pemesanan::with('kamar')->find($id);
        $kamar = Kamar::all();
        return view('pemesanan.edit', [
            'pemesanan' => $edit,
            'kamar' => $kamar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'kamar_id' => 'required',
            'tangal_pesan' => 'required|date',
            'tanggl_masuk' => 'required|date',
            'status_pembayaran' => 'required'
        ]);
        $pemesanan->update([
            'user_id' => auth()->user()->id,
            'kamar_id' => $request->kamar_id,
            'tangal_pesan' => $request->tangal_pesan,
            'tanggl_masuk' => $request->tanggl_masuk,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return Redirect::to('/dashboard/pemesanan')->with('success', 'pesanan berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return Redirect::to('/dashboard/pemesanan')->with('success', 'pesanan berhasil dihapus');
    }
}

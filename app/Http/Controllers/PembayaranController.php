<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Kamar;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $pembayaran = Pemesanan::with('pembayaran')->get();
        } else {
            $pembayaran = Pemesanan::with('pembayaran')->where('user_id',auth()->user()->id)->get();
        }
        // dd($pembayaran);
        return view('pembayaran.index',[
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pembayran = Pemesanan::with('kamar')->find($id);
        return view('pembayaran.create', [
            'pembayaran' => $pembayran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $pesanan = Pemesanan::find($id);
        // dd($pesanan);
        // dd($request);
        $request->validate([
            'tanggal_pembayaran' => 'required|date', 
            'bank' => 'required|string', 
            'no_rekening' => 'required|string', 
            'harga_pembayaran' => 'required|numeric', 
            'bukti_pembayaran' => 'required|file', 
        ]);


        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti_pembayaran', $fileName); 
        }


        $pembayaran = new Pembayaran();
        $pembayaran->pemesanan_id = $id;
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->bank = $request->bank;
        $pembayaran->no_rekening = $request->no_rekening;
        $pembayaran->harga_pembayaran = $request->harga_pembayaran;
        $pembayaran->bukti_pembayaran = $fileName;
        $pembayaran->save();

        $pesanan->status_pembayaran = 'lunas';
        $pesanan->save();

        return Redirect::to('/dashboard/pembayaran')->with('success', 'Pembayaran telah success, silahkan tunggu confirmasi admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $editPembayaran = Pemesanan::with('pembayaran')->find($id);
        $kamar = Kamar::all();
        return view('pembayaran.edit',[
            'edit_pembayaran' => $editPembayaran,
            'kamar' => $kamar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        // dd($request);
        $request->validate([
            'pemesanan_id' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'bank' => 'required',
            'no_rekening' => 'required|string',
            'harga_pembayaran' => 'required|numeric',
            'bukti_pembayaran' => 'required|file',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $oldFile = $pembayaran->bukti_pembayaran;
            if ($oldFile) {
                Storage::delete('public/bukti_pembayaran/' . $oldFile);
            }
            $fileName = time() . '_' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $request->file('bukti_pembayaran')->storeAs('public/bukti_pembayaran', $fileName);
            $pembayaran->bukti_pembayaran = $fileName;
        }
        $pembayaran->update([
            'pemesanan_id' => $request->pemesanan_id,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'bank' => $request->bank,
            'no_rekening' => $request->no_rekening,
            'harga_pembayaran' => $request->harga_pembayaran,
        ]);
        return Redirect::to('/dashboard/pembayaran')->with('success', 'Pembayaran telah di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $oldFile = $pembayaran->bukti_pembayaran;
        if ($oldFile) {
            Storage::delete('public/bukti_pembayaran/' . $oldFile);
        }
        $pembayaran->delete();
        return Redirect::to('/dashboard/pembayaran')->with('success', 'Pembayaran telah dihapus');
    }
    public function pdf($id){
        $pembayaran = Pemesanan::with('pembayaran')->find($id);
        // dd($pembayaran);
        return view('pembayaran.buktipembayaran',[
            'pembayaran' => $pembayaran
        ]);
    }
}
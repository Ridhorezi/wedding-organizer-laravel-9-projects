<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\PaketWedding;
use App\Models\ProfileWeb;
use App\Models\User;

use Alert;

class DataPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        $data['data_pesanan'] = Pemesanan::all();
        return view('back.data_pesanan.data', $data);
    }

    public function select(Request $request) {
        $select_val = $request->status_pembayaran;
        if($request->ajax()){
            $data_pesanan = Pemesanan::where('status_pembayaran',$select_val)->get();
            return view('back.data_pesanan.select', compact('data_pesanan'))->render();
        }
    }

    public function getUser(Request $request) {

        $user = User::where('id', $request->user_id)->first();

        return $user->nama;
    }

    public function getPaketWedding(Request $request) 
    {
        $data_paket = PaketWedding::where('id', $request->paket_wedding_id)->first();
     
        return $data_paket->nama_paket;
    }


    public function getTotalHarga(Request $request) 
    {
        $pemesanan = Pemesanan::where('id', $request->id_pemesanan)->first();   

        $jumlah = 0;

        $jumlah = (int) $pemesanan->jumlah_paket * (int) $pemesanan->paket_wedding->harga_paket;  

        return $jumlah;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $data = [
            'pemesan' => $request->edit_pemesan ? $request->edit_pemesan : $pemesanan->pemesan,
            // 'jumlah_paket' => $request->edit_jumlah_paket ? $request->edit_jumlah_paket : $pemesanan->jumlah_paket,
            // 'tempat_acara' => $request->edit_tempat_acara ? $request->edit_tempat_acara : $pemesanan->tempat_acara,
            // 'tanggal_acara' => $request->edit_tanggal_acara ? $request->edit_tanggal_acara : $pemesanan->tanggal_acara,
            'status_pembayaran' => $request->edit_status_pembayaran ? $request->edit_status_pembayaran : $pemesanan->status_pembayaran,
        ];

        $pemesanan->update($data)
        ? Alert::success('Berhasil', "Pemesanan telah berhasil diubah!")
        : Alert::error('Error', "Pemesanan gagal diubah!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesanan = Pemesanan::find($id);

        $pesanan->delete()
        ? Alert::success('Sukses', "Data Pemesanan berhasil dihapus.")
        : Alert::error('Error', "Data Pemesanan gagal dihapus!");

        return redirect()->back();
    }
}

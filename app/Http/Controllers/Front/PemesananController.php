<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\PaketWeddingFoto;
use App\Models\ProfileWeb;
use App\Models\Keranjang;
use Alert;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function pemesanan_wa($id)
    {
        if(Pemesanan::where('user_id', $id)->first()) {
            $data['web'] = ProfileWeb::all();
            $data['keranjang'] = Keranjang::all();
            $data['paket_wedding_random'] = PaketWeddingFoto::groupBy('paket_wedding_id')->inRandomOrder()->limit(4)->get();
            return view('front.pembayaran_wa', $data);
        } else {
            return redirect('/');
        }
       
    }

    public function batal(Request $request)
    {
        $pemesanan = Pemesanan::where('user_id', $request->id)->get();

        foreach($pemesanan as $data) {
            $data->delete();

            $statusBatal = "berhasil";
        }

        if($statusBatal) {
            return $data = ['berhasil'];
        } else {
            return "gagal";        
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $check = Pemesanan::where('user_id', $request->user_id)->first();
        
            foreach($request->paket_wedding_id as $item) {
           
                $dataKeranjang = Keranjang::where('id', $item)->first();

                Pemesanan::create([
                    'paket_wedding_id' => $dataKeranjang->paket_wedding_id,
                    'user_id' => $dataKeranjang->user_id,
                    'jumlah_paket' => $dataKeranjang->jumlah_paket,
                    'tempat_acara' => $request->tempat_acara,
                    'tanggal_acara' => $request->tanggal_acara,
                    'status_pembayaran' => 'belum',
                ]);
           
                $dataKeranjang->delete();

                $statusCreate = "berhasil";
            }
            
        if($check) {
            return $data = ['redirect'];    
        } else {
           
            if($statusCreate) {
                return $data = ['berhasil'];
            } else {
                return "gagal";        
            }
        }
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

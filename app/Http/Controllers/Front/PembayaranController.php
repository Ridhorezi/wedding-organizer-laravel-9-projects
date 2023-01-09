<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketWeddingFoto;
use App\Models\Keranjang;
use App\Models\ProfileWeb;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        $data['keranjang'] = Keranjang::all();
        $data['paket_wedding_random'] = PaketWeddingFoto::groupBy('paket_wedding_id')->inRandomOrder()->limit(4)->get();
        return view('front.pembayaran', $data);
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
        $data = [
            'paket_wedding_id' => $request->paket_wedding_id,
            'user_id' => $request->user_id,
            'alamat' => $request->jumlah_paket,
        ];

        $check = Keranjang::where('paket_wedding_id', $request->paket_wedding_id)->first();
        
        if($check) {

            $sum =  $check->jumlah_paket + $request->jumlah_paket;

            if($check->update(['jumlah_paket' => $sum])) {
                $updated = Keranjang::where('paket_wedding_id', $request->paket_wedding_id)->first();
                return $data = ['berhasil', $updated->jumlah_paket];
            }else {
                return "gagal";        
            }

        } else {
            if(Keranjang::create($data)) {
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
        $data['web'] = ProfileWeb::all();
        $data['keranjang'] = Keranjang::where('user_id', $id)->get();
        $data['paket_wedding_random'] = PaketWeddingFoto::groupBy('paket_wedding_id')->inRandomOrder()->limit(4)->get();

        return view('front.pembayaran', $data);
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

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use Alert;

class KeranjangController extends Controller
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
            'jumlah_paket' => $request->jumlah_paket,
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

    public function to_pembayaran(Request $request)
    {
        $data = [
            'jumlah_paket' => $request->jumlah_paket
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
                return "berhasil";
            } else {
                return "gagal";        
            }
        }
    }

    public function quantity_canvas(Request $request)
    {
        // $data = [
        //     'jumlah_paket' => $request->jumlah_paket
        // ];

        $keranjang = Keranjang::where('id', $request->keranjang_id)->first();
        
        if($keranjang) {
            $sum =  $keranjang->jumlah_paket;
            if($request->jumlah_paket_tambah) {
                $sum =  $request->jumlah_paket_tambah;
            } else if($request->jumlah_paket_kurang) {
                $sum =  $request->jumlah_paket_kurang;
            }

            if($keranjang->update(['jumlah_paket' => $sum])) {
                if($request->cart_quantity) {
                    $updated = Keranjang::all();
                    
                    $jumlah = 0;

                    foreach($updated as $data) {
                        $jumlah += (int) $data->jumlah_paket * (int) $data->paket_wedding->harga_paket;
                    }

                    return $data = ['berhasil', $jumlah];
                } else {

                    $all = Keranjang::all();
                    
                    $jumlah = 0;

                    foreach($all as $data) {
                        $jumlah += (int) $data->jumlah_paket * (int) $data->paket_wedding->harga_paket;
                    }

                    $updated = Keranjang::where('id', $request->keranjang_id)->first();
                    return $data = ['berhasil', $updated->jumlah_paket * $updated->paket_wedding->harga_paket, $jumlah];
                }
            }else {
                return "gagal";        
            }

        } else {
            if(Keranjang::create($data)) {
                return "berhasil";
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
    public function hapus(Request $request)
    {
        $keranjang = Keranjang::find($request->id);

        if($keranjang->delete()) {
            return "berhasil";
        } else {
            return "gagal";        
        }
    }
}

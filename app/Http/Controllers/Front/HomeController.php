<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketWedding;
use App\Models\PaketWeddingFoto;
use App\Models\Keranjang;
use App\Models\ProfileWeb;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        $data['paket_wedding'] = PaketWedding::orderBy('id', 'asc')->limit(8)->get();
        $data['keranjang'] = Keranjang::all();
        return view('front.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function paket_wedding() 
    {
        $data['web'] = ProfileWeb::all();
        $data['paket_wedding'] = PaketWedding::paginate(6);
        $data['keranjang'] = Keranjang::all();
        return view('front.paket_wedding', $data);
    }

    public function detail_paket_wedding($slug) 
    {
        $data['web'] = ProfileWeb::all();
        $data['keranjang'] = Keranjang::all();
        $data['paket_wedding'] = PaketWedding::where('slug', $slug)->first();
        $data['paket_wedding_random'] = PaketWeddingFoto::groupBy('paket_wedding_id')->inRandomOrder()->limit(4)->get();
        return view('front.detail_paket_wedding', $data);
    }
    
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

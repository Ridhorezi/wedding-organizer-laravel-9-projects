<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketWedding;
use App\Models\PaketWeddingFoto;
use App\Models\ProfileWeb;
use File;
use Storage;
use Alert;
use Str;

class PaketWeddingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        $data['paket_wedding'] = PaketWedding::paginate(6);
        return view('back.paket_wedding.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
        $search_val = $request->search;
        if($request->ajax()){
            $paket_wedding = PaketWedding::where('nama_paket','LIKE',"%{$search_val}%")->paginate(6);
            return view('back.paket_wedding.search', compact('paket_wedding'))->render();
        }
    }

    public function paginate(Request $request) {
        $search_val = $request->search;
        if($request->ajax()){
            $paket_wedding = PaketWedding::paginate(6);
            return view('back.paket_wedding.paginate', compact('paket_wedding'))->render();
        }
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
        $data = [
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket,
            'deskripsi_paket' => $request->deskripsi_paket,
            'slug' => Str::slug($request->nama_paket)
        ];

       

        $paket_wedding = PaketWedding::create($data);

        $file_foto = $request->file('file');
        
        foreach ($file_foto as $foto) {
            $size = $foto->getSize();
           
            $nama_foto = time()."_".$foto->getClientOriginalName();
            $tujuan_upload = 'paket_wedding';
            $foto->move($tujuan_upload,$nama_foto);

            PaketWeddingFoto::create([
                'paket_wedding_id' => $paket_wedding->id,
                'name' => $foto->getClientOriginalName(),
                'size' => $size,
                'url' => $nama_foto
            ]);
        }

        if($request->ajax()) {
            return response()->json([
                'sukses'          => 'berhasil',
            ]);
        } else {
            return redirect()->route('paket-wedding.index');
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
    public function update($id, Request $request)
    {

        

        $paket_wedding = PaketWedding::findOrFail($id);

        $photo = $request->input('photo');
        if ($request->input('photo')) {
            foreach($photo as $checko){
                $pgid = PaketWeddingFoto::find($checko);

                if($pgid != null) {
                    $pgid->delete();

                    $StoredImage = public_path("paket_wedding/{$pgid->url}");
                    if (File::exists($StoredImage) && !empty($pgid->url)) {
                        unlink($StoredImage);
                    }
                }
        
            }
        }

        // if($request->photo != null) {

        //     foreach($request->photo as $data_id) {
        //         $paket_wedding_foto_get = PaketWeddingFoto::find($data_id);
        //         $paket_wedding_foto_get->delete();

        //         $StoredImage = public_path("paket_wedding/{$paket_wedding_foto_get->url}");
        //         if (File::exists($StoredImage) && !empty($paket_wedding_foto_get->url)) {
        //             unlink($StoredImage);
        //         }

        //         $status = "berhasil";
        //     }
        // }
        
        $file_foto = $request->file('file');
       
        if ($request->file('file')) {
            foreach ($file_foto as $foto) {
                $size = "243";

                $nama_foto = time()."_".$foto->getClientOriginalName();
                $tujuan_upload = 'paket_wedding';
                $foto->move($tujuan_upload,$nama_foto);
    
                PaketWeddingFoto::create([
                    'paket_wedding_id' => $paket_wedding->id,
                    'name' => $foto->getClientOriginalName(),
                    'size' => $size,
                    'url' => $nama_foto
                ]);
                $status = "berhasil";
            }
        }
       
        $data = [
            'nama_paket' => $request->edit_nama_paket ? $request->edit_nama_paket : $paket_wedding->nama_paket,
            'harga_paket' => $request->edit_harga_paket ? $request->edit_harga_paket : $paket_wedding->harga_paket,
            'deskripsi_paket' => $request->edit_deskripsi_paket ? $request->edit_deskripsi_paket : $paket_wedding->deskripsi_paket,
            'slug' => $request->edit_nama_paket ? Str::slug($request->edit_nama_paket) : $paket_wedding->nama_paket,
        ];
       
        $paket_wedding->update($data);

        Alert::success('Sukses', "Paket telah berhasil di ubah!");

        return redirect()->route('paket-wedding.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket_wedding = PaketWedding::findOrFail($id);

        $paket_wedding_foto_get = PaketWeddingFoto::where('paket_wedding_id', $id)->get();

        foreach($paket_wedding_foto_get as $data_foto) {
            $StoredImage = public_path("paket_wedding/{$data_foto->url}");
            if (File::exists($StoredImage) && !empty($data_foto->url)) {
                unlink($StoredImage);
            }
        }

        foreach($paket_wedding_foto_get as $delete_db) {
            $delete_db->delete();
        }

        $paket_wedding->delete()
        ? Alert::success('Sukses', "Paket Wedding tetap berhasil dihapus.")
        : Alert::error('Error', "Paket Wedding tetap gagal dihapus!");
        
        return redirect()->back();
    }

    function getFotoPaket(Request $request)
    {
        $paket_wedding_id = $request->paket_wedding_id;
      
        $paket_wedding = PaketWeddingFoto::where('paket_wedding_id', $paket_wedding_id)->get();

        return response()->json($paket_wedding);
    }
}

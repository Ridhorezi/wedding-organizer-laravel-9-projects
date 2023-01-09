<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileWeb;
use Alert;

class ProfileWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        return view('back.profile_web.data', $data);
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
        $file_logo = $request->file('logo');
        
        $nama_logo = time()."_".$file_logo->getClientOriginalName();
        $tujuan_upload = 'profile';
        $file_logo->move($tujuan_upload,$nama_logo);

        $data = [
            'logo' => $nama_logo,
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'twitter' => $request->twitter,
            'whatsapp' => $request->whatsapp,
        ];

        ProfileWeb::create($data)
        ? Alert::success('Berhasil', 'Profile Web telah berhasil ditambahkan!')
        : Alert::error('Error', 'Profile Web gagal ditambahkan!');

        return redirect()->back();
        
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
        $web = ProfileWeb::findOrFail($id);

        if($request->hasFile('edit_logo')) {
            // if(Storage::exists($web->logo) && !empty($web->logo)) {
            //     Storage::delete($web->logo);
            // }

            $edit_file_logo = $request->file('edit_logo');

            $edit_nama_logo = time()."_".$edit_file_logo->getClientOriginalName();
            $tujuan_upload = 'profile';
            $edit_file_logo->move($tujuan_upload,$edit_nama_logo);

        }

        $data = [
            'logo' =>  $request->hasFile('edit_logo') ? $edit_nama_logo : $web->logo,
            'name' => $request->edit_name ? $request->edit_name : $web->name,
            'description' => $request->edit_description ? $request->edit_description : $web->description,
            'address' => $request->edit_address ? $request->edit_address : $web->address,
            'email' => $request->edit_email ? $request->edit_email : $web->email,
            'facebook' => $request->edit_facebook ? $request->edit_facebook : $web->facebook,
            'instagram' => $request->edit_instagram ? $request->edit_instagram : $web->instagram,
            'youtube' => $request->edit_youtube ? $request->edit_youtube : $web->youtube,
            'twitter' => $request->edit_twitter ? $request->edit_twitter : $web->twitter,
            'whatsapp' => $request->edit_whatsapp ? $request->edit_whatsapp : $web->whatsapp,
        ];

        $web->update($data)
        ? Alert::success('Berhasil', "Profil Web telah berhasil diubah!")
        : Alert::error('Error', "Profil Web gagal diubah!");

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
        $profile_web = ProfileWeb::find($id);
        $profile_web->delete()
        ? Alert::success('Berhasil', "Profil Web telah berhasil dihapus!")
        : Alert::error('Error', "Profil Web gagal dihapus!");

        return redirect()->back();
    }
}

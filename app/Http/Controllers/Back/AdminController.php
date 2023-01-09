<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\ProfileWeb;
use App\Rules\MatchOldPassword;
use Alert;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        $data['admin'] = Admin::all();
        return view('back.manajemen_akun.admin', $data);
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
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        Admin::create($data)
        ? Alert::success('Sukses', "Admin berhasil ditambahkan.")
        : Alert::error('Error', "Admin gagal ditambahkan!");

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

    public function edit_password_admin($id) 
    {
        $data['web'] = ProfileWeb::all();
        $data['admin'] = Admin::find($id);   
        return view('back.manajemen_akun.update_password_admin', $data);
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
        $user = Admin::find($id);
       
        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $user->nama,
            'username' => $request->edit_username ? $request->edit_username : $user->username
        ];

        $user->update($data)
            ? Alert::success('Sukses', "Akun anda berhasil diubah.")
            : Alert::error('Error', "Akun anda gagal diubah!");

        return redirect()->back();
    }

    public function update_password(Request $request, $id) 
    {
            $admin = Admin::find($id);

            $this->validate($request, [
           
                // 'password_lama' => ['required', new MatchOldPassword],
                'password_baru' => 'required',
                'konfirmasi_password_baru' => 'same:password_baru',
            ],
            [
                'password_lama.required' => 'Password Lama harus di isi.',
                'password_baru.required' => 'Password Baru harus di isi.',
                'konfirmasi_password_baru.same' => 'Konfirmasi Password Baru tidak sama.',
            ]);
        
        
        $data = [
            'password' => Hash::make($request->password_baru)
        ];

        $admin->update($data)
            ? Alert::success('Sukses', "Password Admin telah berhasil diubah.")
            : Alert::error('Error', "Password Admin gagal diubah!");

        return redirect()->back();
    }

    function checkUsernameAdmin(Request $request)
    {
        if($request->Input('username')){
            $username = Admin::where('username',$request->Input('username'))->first();
            if($username){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_username')){
            $checkUsername = Admin::where('username',$request->Input('edit_username'))->first();
            if($checkUsername){
                return 'false';
            }else{
                return  'true';
            }
        }
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        $admin->delete()
        ? Alert::success('Sukses', "Admin telah berhasil dihapus.")
        : Alert::error('Error', "Admin gagal dihapus!");

        return redirect()->back();
    }
}

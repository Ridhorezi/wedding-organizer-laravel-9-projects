<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileWeb;
use App\Rules\MatchOldPassword;
use Alert;
use Hash;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['web'] = ProfileWeb::all();
        $data['users'] = User::all();
        return view('back.manajemen_akun.user', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_setting()
    {
        $data['web'] = ProfileWeb::all();

        return view('back.user_setting.data', $data);
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
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password)
        ];

        User::create($data)
        ? Alert::success('Sukses', "User berhasil ditambahkan.")
        : Alert::error('Error', "User gagal ditambahkan!");

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

    public function edit_password($id) 
    {
        $data['web'] = ProfileWeb::all();
        $data['user'] = User::find($id);   
        return view('back.manajemen_akun.update_password', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function update(Request $request,$id)
    {
        $user = User::find($id);
       
        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $user->nama,
            'username' => $request->edit_username ? $request->edit_username : $user->username,
            'email' => $request->edit_email ? $request->edit_email : $user->email,
            'no_hp' => $request->edit_no_hp ? $request->edit_no_hp : $user->no_hp,
            'alamat' => $request->edit_alamat ? $request->edit_alamat : $user->alamat,
        ];

        $user->update($data)
            ? Alert::success('Sukses', "Akun anda berhasil diubah.")
            : Alert::error('Error', "Akun anda gagal diubah!");

        return redirect()->back();
    }


    public function update_password(Request $request, $id) 
    {
            $user = User::find($id);

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

        $user->update($data)
            ? Alert::success('Sukses', "User telah berhasil diubah.")
            : Alert::error('Error', "User gagal diubah!");

        return redirect()->back();
    }


    function checkUsername(Request $request)
    {
        if($request->Input('username')){
            $username = User::where('username',$request->Input('username'))->first();
            if($username){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_username')){
            $checkUsername = User::where('username',$request->Input('edit_username'))->first();
            if($checkUsername){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

    function checkEmail(Request $request)
    {
        if($request->Input('email')){
            $email = User::where('email',$request->Input('email'))->first();
            if($email){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_email')){
            $checkEmail = User::where('email',$request->Input('edit_email'))->first();
            if($checkEmail){
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

    public function clear()
    {
        $users = User::all()->except(auth()->id());

        foreach ($users as $user) {

            $user->storedVoters()->delete();
            $user->delete();
            
        }

        (count(User::all()) <= 1)
            ? Alert::success('Sukses', "Users berhasil dibersihkan.")
            : Alert::error('Error', "Users gagal dibersihkan!");

        return redirect(route('manajemen-akun.index'));
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $users = User::find($id);

        $users->delete()
        ? Alert::success('Sukses', "User berhasil dihapus.")
        : Alert::error('Error', "User gagal dihapus!");

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Alert;
use Hash;

class LoginFrontController extends Controller
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

    public function create_user(Request $request)
    {

            $data = [
                'nama' => $request->register_nama,
                'username' => $request->register_username,
                'email' => $request->register_email,
                'no_telp' => $request->register_no_hp,
                'alamat' => $request->register_alamat,
                'password' => Hash::make($request->register_password)
            ];
    
            if(User::create($data)) {
                return "berhasil";
            } else {
                return "gagal";
            }
    }
    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;
        
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt(array('username' => $input['username'], 'password' => $input['password']), $remember)) {
            return response()->json([
                'status'          => 'berhasil',
            ]);
        } else {
            return response()->json([
                'status'          => 'gagal',
            ]);
        }
    }

    public function logout()
    {
        if(Auth::guard('web')->check()) 
        {
            Auth::guard('web')->logout();
            return redirect('/');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect('/');
        
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

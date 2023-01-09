<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileWeb;
use Storage;
use Alert;
use Hash;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.login.data');
    }

    public function login()
    {
        $data['web'] = ProfileWeb::all();
        return view('back.login.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
        $data['web'] = Web::all();
        return view('back.profile.index', $data);
    }

    public function checkProfileUsername(Request $request)
    {
        if($request->Input('username')){
            $username = User::where('username',$request->Input('username'))->first();
            if($username){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

    public function checkProfileEmail(Request $request)
    {
        if($request->Input('email')){
            $email = User::where('email',$request->Input('email'))->first();
            if($email){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($request->hasFile('photo')) {
            if(Storage::exists($user->photo) && !empty($user->photo)) {
                Storage::delete($user->photo);
            }

            $photo = $request->file("photo")->store("/public/input/users");
        }
        $data = [
            'fullname' => $request->fullname ? $request->fullname : $user->fullname,
            'username' => $request->username ? $request->username : $user->username,
            'email' => $request->email ? $request->email : $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'address' => $request->address ? $request->address : $user->address,
            'phone' => $request->phone ? $request->phone : $user->phone,
            'gender' => $request->gender ? $request->gender : $user->gender,
            'photo' => $request->hasFile('photo') ? $photo : $user->photo,
            'place_of_birth' => $request->place_of_birth ? $request->place_of_birth : $user->place_of_birth,
            'date_of_birth' => $request->date_of_birth ? $request->date_of_birth : $user->date_of_birth
        ];

        $user->update($data)
        ? Alert::success('Berhasil', "User telah berhasil diubah!")
        : Alert::error('Error', "User gagal diubah!");

        return redirect()->back();
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
        $remember = $request->remember ? true : false;

        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

            if (Auth::guard('admin')->attempt(array('username' => $input['username'], 'password' => $input['password']), $remember)) {
                return redirect()->route('dashboard.index');
            } else {
                Alert::error('Error', 'Username atau Password salah!');
                return redirect()->back();
            }

    }

    public function logout()
    {
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');
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

    }
}

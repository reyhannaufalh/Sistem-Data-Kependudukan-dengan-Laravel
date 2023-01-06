<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Login81Controller extends Controller
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

    public function login81()
    {
        return view('auth/login');
    }

    public function register81()
    {
        return view('auth/register');
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
    public function store81(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $userData = $request->all();
        $userData["password"] = bcrypt($request->password);

        $user = new User();
        $user->fill($userData);
        $save = $user->save();

        $detailUser = new Detail();
        $detailUser->id_user = $user->id;
        $detailUser->save();

        if ($save && $detailUser) {
            return redirect('/login81')->with('success', 'Register berhasil');
        } else {
            return back()->with('error', 'Register gagal');
        }
    }

    public function proseslogin81(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $name = $request->old('name');
        $password = $request->old('password');

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->role == 'User') {
                if ($user->is_aktif == 0) {
                    return back();
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/admin81');
            }
        } else {
            Session::flash('error', 'Email atau Password salah!');
            // return redirect('/login81');
            return back()->with('toast_success', 'Email atau Password salah');
        }
    }

    public function logout81()
    {
        Auth::logout();
        return redirect('/login81');
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
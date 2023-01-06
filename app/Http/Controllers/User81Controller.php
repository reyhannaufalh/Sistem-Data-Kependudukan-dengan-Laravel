<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Agama81;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User81Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index81()
    {
        $user = Auth::user();
        $agama = Agama::all();

        $usersData = User::find($user->id);
        $detail = $usersData->detail;
        $all_data = array_merge($usersData->toArray(), $detail->toArray());

        return view('user.dashboard', ['user' => $all_data, 'agama' => $agama]);
    }

    public function admin81()
    {
        $user = Auth::user();
        $agama = Agama::all();

        $usersData = User::all()->where('role', 'User');
        $detail = Detail::all();

        return view('admin.list', ['user' => $usersData, 'detail' => $detail, 'agama' => $agama]);
    }

    public function crudagama81()
    {
        $agama = Agama::all();
        return view('admin.crudagama', compact('agama'));
    }

    public function deleteagama81($id)
    {
        $agama = Agama::findorfail($id);
        $agama->delete();
        if ($agama) {
            return back()->with('success', 'Agama Berhasil DiHapus');
        } else {
            return back()->with('error', 'Agama Gagal DiHapus');
        }
    }

    public function statusaktif81(Request $request, $id)
    {
        $dataPenduduk = User::findorfail($id);
        $dataPenduduk->update(['is_aktif' => 1]);
        return back();
    }

    public function ubahfotoprofil81(Request $request)
    {
        $request->validate([
            'foto' => 'required',
        ]);

        $user = Auth::user();
        $detail = User::find($user->id);
        $id = $request->id;
        $image = $request->file('foto');
        $image_name = $image->getClientOriginalName();
        $folder = 'foto_profil';

        $new_image_name = Str::uuid();
        $extension = $image->getClientOriginalExtension();

        $image->move($folder, $new_image_name . "." . $extension);

        $imagePost = $new_image_name . "." . $extension;

        $foto = User::findorfail($id);
        $foto->update(['foto' => $imagePost]);

        if ($foto) {
            return back()->with('success', 'Ubah Foto Berhasil');
        } else {
            return back()->with('error', 'Ubah Foto Gagal');
        }
    }

    public function ubahfotoktp81(Request $request)
    {
        $request->validate([
            'foto_ktp' => 'required',
        ]);

        $user = Auth::user();
        $detail = User::find($user->id);
        $id = $request->id;
        $image = $request->file('foto_ktp');
        $image_name = $image->getClientOriginalName();
        $folder = 'foto_ktp';

        $new_image_name = Str::uuid();
        $extension = $image->getClientOriginalExtension();

        $image->move($folder, $new_image_name . "." . $extension);

        $imagePost = $new_image_name . "." . $extension;

        $foto = Detail::findorfail($id);
        $foto->update(['foto_ktp' => $imagePost]);

        if ($foto) {
            return back()->with('success', 'Ubah Foto Berhasil');
        } else {
            return back()->with('error', 'Ubah Foto Gagal');
        }
    }

    public function ubahdatauser81(Request $request)
    {

        $id = $request->id;
        $dataPenduduk = Detail::findorfail($id);
        $dataPenduduk->update($request->all());
        $umur = date_diff(date_create($request->tanggal_lahir), date_create('now'))->y;
        $dataPenduduk->update(['umur' => $umur]);
        return back()->with('toast_success', 'Data Berhasil Dirubah!');
    }

    public function ubahpassword81(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $id = $request->id;
        $dataPenduduk = User::findorfail($id);
        $password_lama = $request->old_password;

        if (!Hash::check($password_lama, $dataPenduduk->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        $password_baru = bcrypt($request->password);
        $dataPenduduk->update(['password' => $password_baru]);

        if ($dataPenduduk) {
            return back()->with('success', 'Update password berhasil');
        } else {
            return back()->with('error', 'Update password gagal');
        }
    }

    public function ubahagama81(Request $request)
    {
        $id = $request->id;
        $id_agama = $request->id_agama;
        $agama = Detail::findorfail($id);
        $agama->update(['id_agama' => $id_agama]);
        if ($agama) {
            return back()->with('success', 'Agama berhasil dirubah');
        } else {
            return back()->with('error', 'Agama gagal dirubah');
        }
    }

    public function tambahagama81(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required'
        ]);

        $createAgama = Agama::create([
            'nama_agama' => $request->nama_agama
        ]);

        if ($createAgama) {
            return back()->with('success', 'Agama berhasil ditambahkan');
        } else {
            return back()->with('error', 'Agama gagal ditambahkan');
        }
    }

    public function statusnonaktif81(Request $request, $id)
    {
        $dataPenduduk = User::findorfail($id);
        $dataPenduduk->update(['is_aktif' => 0]);
        return back();
    }

    public function detail81(Request $request, $id)
    {
        $user = Auth::user();
        // $agama = Agama81::all();

        $usersData = User::find($id);
        $detail = $usersData->detail;
        $agama = Agama::find($id);
        $all_data = array_merge($usersData->toArray(), $detail->toArray());

        return view('admin.detail', ['user' => $all_data, 'agama' => $agama]);
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
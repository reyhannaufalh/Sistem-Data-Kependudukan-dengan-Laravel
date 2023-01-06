<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Agama;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ApiUser81Controller extends Controller
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

    public function user($id)
    {
        $agama = Agama::all();

        $data = Detail::where('id', $id)->with('user', 'agama')->get();
        return new PostResource(true, 'Data User', ['user' => $data, 'agama' => $agama]);
    }

    public function admin()
    {
        $dataUser = User::latest()->get()->where('role', 'User');
        return new PostResource(true, 'List Data', $dataUser);
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

    public function ubahfotoprofil81(Request $request)
    {
        // $request->validate([
        //     'foto' => 'required',
        // ]);

        $user = Auth::user();
        $id = $request->id;
        $image = $request->foto;
        $folder = 'foto_profil';

        // $new_image_name = Str::uuid();
        // $extension = $image->getClientOriginalExtension();

        // $image->move($folder, $new_image_name . "." . $extension);

        // $imagePost = $new_image_name . "." . $extension;

        $foto = User::findorfail($id);
        $foto->update(['foto' => $image]);

        return new PostResource(true, 'Foto Berhasil Diupdate', $foto);
    }

    public function ubahktpuser81(Request $request)
    {
        $request->validate([
            'foto_ktp' => 'required',
        ]);

        $user = Auth::user();
        $id = $request->id;
        $image = $request->foto_ktp;
        $folder = 'foto_ktp';

        // $new_image_name = Str::uuid();
        // $extension = $image->getClientOriginalExtension();

        // $image->move($folder, $new_image_name . "." . $extension);

        // $imagePost = $new_image_name . "." . $extension;

        $foto = Detail::findorfail($id);
        $foto->update(['foto_ktp' => $image]);

        return new PostResource(true, 'Data Berhasil Diupdate', $foto);
    }

    public function detailuser($id)
    {
        $usersData = User::where('id', '=', $id)->get();
        $detail = Detail::where('id', '=', $id)->get();
        $agama = Agama::where('id', '=', $id)->get();
        // $usersData = User::find($id);
        // $detail = $usersData->detail;
        // $agama = Agama::find($id);
        $data = array_merge($usersData->toArray(), $detail->toArray());

        return new PostResource(true, 'Detail Data', ['user' => $usersData, 'detail' => $detail, 'agama' => $agama]);
        // return new PostResource(true, 'Detail Data', ['user' => $data, 'agama' => $agama]);
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

    public function ubahpassword(Request $request)
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
            return new PostResource(true, 'Password Berhasil Diupdate', $dataPenduduk);
        } else {
            return back()->with('error', 'Update password gagal');
            return new PostResource(false, 'Password Gagal Diupdate', $dataPenduduk);
        }
    }

    public function statusaktif(Request $request, $id)
    {
        $user = User::findorfail($id);
        $user->update([
            'is_aktif' => 1
        ]);
        return new PostResource(true, 'Data Berhasil Diupdate', $user);
    }

    public function statusnonaktif(Request $request, $id)
    {
        $user = User::findorfail($id);
        $user->update([
            'is_aktif' => 0
        ]);
        return new PostResource(true, 'Data Berhasil Diupdate', $user);
    }

    public function updateuser(Request $request, $id)
    {
        // $id = $request->id;
        // $dataPenduduk = Detail::findorfail($id);
        // $dataPenduduk->update($request->all());
        // $umur = date_diff(date_create($request->tanggal_lahir), date_create('now'))->y;
        // $dataPenduduk->update(['umur' => $umur]);
        // return back()->with('toast_success', 'Data Berhasil Dirubah!');

        $detail = Detail::findorfail($id);
        $detail->update([
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_agama' => $request->id_agama,
        ]);
        return new PostResource(true, 'Data Berhasil Diupdate', $detail);
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

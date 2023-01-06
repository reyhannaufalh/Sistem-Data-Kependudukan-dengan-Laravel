<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Detail;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ApiClientUserController81 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function user()
    {
        $id = Auth::user()->id;

        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1/UAS_V3421081/public/api/user/user81/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $data = json_decode($body, true);

        return view('/apiclient/user/user', ['user' => $data['data']]);
    }

    public function admin()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1/UAS_V3421081/public/api/admin/dashboard81');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        return view('/apiclient/admin/listuser', ['user' => $data]);
    }

    public function detailuser($id)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1/UAS_V3421081/public/api/admin/detailuser81/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        //dd($data);
        return view('/apiclient/admin/detailuser', ['user' => $data]);
    }

    public function updateuser(Request $request, $id)
    {
        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/user/updateuser/' . $id,
            [
                'json' => [
                    'alamat' => $request->alamat,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'id_agama' => $request->id_agama,
                ]
            ]
        );

        return back();
    }

    public function ubahpassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/user/ubahpassword81',
            [
                'json' => [
                    'id' => $request->id,
                    'old_password' => $request->old_password,
                    'password' => $request->password,
                ]
            ]
        );

        return back();
    }

    public function ubahktpuser81(Request $request)
    {
        $image = $request->file('foto_ktp');
        $folder = 'foto_ktp';

        $new_image_name = Str::uuid();
        $extension = $image->getClientOriginalExtension();

        $image->move($folder, $new_image_name . "." . $extension);
        $imagePost = $new_image_name . "." . $extension;

        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/user/ubahktpuser81',
            [
                'json' => [
                    'id' => $request->id,
                    'foto_ktp' => $imagePost,
                ]
            ]
        );

        return back();
    }

    public function ubahfotoprofil81(Request $request)
    {
        $image = $request->file('foto');
        $folder = 'foto_profil';

        $new_image_name = Str::uuid();
        $extension = $image->getClientOriginalExtension();

        $image->move($folder, $new_image_name . "." . $extension);
        $imagePost = $new_image_name . "." . $extension;

        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/user/ubahfotoprofil81',
            [
                'json' => [
                    'id' => $request->id,
                    'foto' => $imagePost,
                ]
            ]
        );

        return back();
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
        $id = $request->id;
        $dataPenduduk = Detail::findorfail($id);
        $dataPenduduk->update($request->all());
        $umur = date_diff(date_create($request->tanggal_lahir), date_create('now'))->y;
        $dataPenduduk->update(['umur' => $umur]);
        return back()->with('toast_success', 'Data Berhasil Dirubah!');
    }

    public function statusaktif(Request $request, $id)
    {
        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/admin/statusaktif81/' . $id,
            [
                'json' => [
                    'is_aktif' => $request->is_aktif,
                ]
            ]
        );

        return redirect("/admin/clientapi/dashboard81");
    }

    public function statusnonaktif(Request $request, $id)
    {
        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/admin/statusnonaktif81/' . $id,
            [
                'json' => [
                    'is_aktif' => $request->is_aktif,
                ]
            ]
        );

        return redirect("/admin/clientapi/dashboard81");
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

<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiClientAgamaController81 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1/UAS_V3421081/public/api/agama/listagama81');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        // dd($data);
        return view('/apiclient/admin/listagama', ['agama' => $data]);
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
        $request->validate([
            'nama_agama' => 'required',
        ]);

        $client = new Client();
        $response = $client->request(
            'POST',
            'http://127.0.0.1/UAS_V3421081/public/api/agama/add',
            [
                'json' => [
                    'nama_agama' => $request->nama_agama,
                ]
            ]
        );

        return back();
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
        $client = new Client();
        $response = $client->request('GET', 'http://127.0.0.1/UAS_V3421081/public/api/agama/detailagama81/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        //dd($data);
        return view('/apiclient/admin/editagama', ['agama' => $data]);
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
        $request->validate([
            'nama_agama' => 'required',
        ]);
        $client = new Client();
        $response = $client->request(
            'PUT',
            'http://127.0.0.1/UAS_V3421081/public/api/agama/update/' . $id,
            [
                'json' => [
                    'nama_agama' => $request->nama_agama,
                ]
            ]
        );

        return redirect("/agama/clientapi/listagama81");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();
        $response = $client->request(
            'DELETE',
            'http://127.0.0.1/UAS_V3421081/public/api/agama/delete/' . $id,
        );

        return back();
    }
}
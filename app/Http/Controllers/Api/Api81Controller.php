<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Agama;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Http\Request;

class Api81Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAgama = Agama::latest()->get();
        return new PostResource(true, 'List Data', $dataAgama);
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
        $addAgama = Agama::create([
            'nama_agama' => $request->nama_agama
        ]);

        return new PostResource(true, 'Data Berhasil Ditambahkan', $addAgama);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Agama::where('id', '=', $id)->get();
        return new PostResource(true, 'Detail Data', $data);
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
        $agama = Agama::findorfail($id);
        $agama->update([
            'nama_agama' => $request->nama_agama
        ]);
        return new PostResource(true, 'Data Berhasil Diupdate', $agama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agama = Agama::findorfail($id);
        $agama->delete();
        return new PostResource(true, 'Hapus Data Berhasil', $agama);
    }
}
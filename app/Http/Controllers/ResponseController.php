<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Response::get();

        $response = [
            'data' => $result
        ];

        return response()->json($response, 201);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $isIdExist = DB::table('complaints')->where('id_pengaduan', $id)->get();

        if(!$isIdExist->isEmpty()){

            $fields = $request->validate([
                'tanggapan' => 'required',
                'id_petugas' => 'required'
            ]);

            $data = Response::create([
                'id_pengaduan' => $id,
                'tgl_tanggapan' => date("Y-m-d"),
                'tanggapan' => $fields['tanggapan'],
                'id_petugas' => $fields['id_petugas'],
                'reponse_deleted' => "not_deleted"
            ]);

            $response = [
                'data' => $data,
                'message' => 'Berhasil menambahkan tanggapan!'
            ];

            return response()->json($response, 201);

        } else {
            return response()->json(["message" => "a"], 400);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('responses')->where('id_tanggapan', $id)->get();

        return response()->json($data, 201);
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
        $isIdExist = DB::table('responses')->where('id_tanggapan', $id)->get();

        if(!$isIdExist->isEmpty()){

            $fields = $request->validate([
                'tanggapan' => 'required'
            ]);


            $data = DB::table('responses')->where('id_tanggapan', $id)->update(['tanggapan' => $fields['tanggapan']]);

            $response = [
                'data' => $data,
                'message' => 'Berhasil merubah tanggapan!'
            ];

            return response()->json($response, 201);

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
        //
    }
}

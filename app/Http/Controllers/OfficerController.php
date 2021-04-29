<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Officer::get();
        $response = [
            'message' => 'Data Pegawai',
            'data' => $people
        ];

        return response()->json($response, 200);
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
        $data = DB::table('officers')->where('id_petugas', $id)->get();

        return response()->json($data, 201);
    }

    public function search($keyword){
        if(is_numeric($keyword)){

            $data = DB::table('officers')->where('id_petugas', 'like', "$keyword%")->get();

        }else{
            $data = DB::table('officers')->where('nama_petugas', $keyword)->orWhere('username', $keyword)->get();
            if($data->isEmpty()){
                $data = DB::table('officers')->where('nama_petugas', 'like', "$keyword%")
                                             ->orWhere('username', 'like', "$keyword%")
                                             ->get();
            }
        }
        $response = [
            'data' => $data
        ];

        return response()->json($response, 201);
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

<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::get();
        $response = [
            'message' => 'Data Masyarakat',
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
    public function show($nik)
    {
        $data = DB::table('people')->where('nik', $nik)->get();

        return response()->json($data, 201);
    }

    public function search($keyword){
        $data = DB::table('people')->where('nik', 'like', "$keyword%")->get();

        $response = [
            'data' => $data,
        ];

        return response()->json($response, 201);
    }

    public function profilePeople($username){
        $data = DB::table('people')->where('username', $username)->first();

        if($data){
            $response = [
                "nama" => $data->nama,
                "nik" => $data->nik,
                "telp" => $data->telp,
            ];

            return response()->json($response, 201);
        }else{
            return response()->json("Data Tidak Ada", 400);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        $fields = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:people,username',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:8,14'
        ]);

        $data = DB::table('people')
                        ->where('nik', $nik)
                        ->update(['nama' => $fields["nama"], "username" => $fields["username"], "telp" => $fields["telp"]]);
            $response = [
                "message" => "Berhasil Update",
                "username" => $fields['username'],
                "data" => $data
            ];

            return response()->json($response, 201);

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

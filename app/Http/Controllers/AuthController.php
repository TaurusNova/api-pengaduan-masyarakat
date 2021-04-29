<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\NikController;

class AuthController extends Controller
{
    protected function Request($url, $nik)
    {
        $ch      = curl_init();
        $options = array(
            CURLOPT_URL => $url . '/pemilih/dpt/1/hasil-cari/resultDps.json?nik=' . $nik . '&nama=&namaPropinsi=&namaKabKota=&namaKecamatan=&namaKelurahan=',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0
        );

        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function search($nik)
    {
        $pk18 = $this->Request('https://infopemilu.kpu.go.id/pilkada2018', $nik);

        $result = !empty($pk17) ? json_decode($pk17) : json_decode($pk18);
        if ($result->aaData) {
            return json_encode($result->aaData);
            exit();
        } else {
            return "NIK tidak ditemukan";
        }
    }

    public function register(Request $request){
        $fields = $request->validate([
            'nik' => 'required|string|unique:people|size:16',
            'nama' => 'required|string',
            'username' => 'required|string|unique:people,username',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:8,14'
        ]);
        // $fields = $request->validate([
        //     'nik' => 'required|string',
        // ]);

        if($fields['confirmPassword'] == $fields['password']){
            $user = People::create([
                'nik' => $fields['nik'],
                'nama' => $fields['nama'],
                'username' => $fields['username'],
                'password' => bcrypt($fields['password']),
                'telp' => $fields['telp']
            ]);

            $response = [
                'user' => $user,
                'message' => 'User berhasil di create!'
            ];

            return response()->json($response, 201);
        }else{
            return response()->json("Password tidak sama!", 401);
        }

        // return $this->search($fields['nik']);
    }

    public function registerPetugas(Request $request){
        $fields = $request->validate([
            'nama_petugas' => 'required|string|max:35',
            'username' => 'required|string|unique:people,username|max:25',
            'password' => 'required|string|min:8',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:8,14',
            'level' => 'required'
        ]);

        $user = Officer::create([
            'nama_petugas' => $fields['nama_petugas'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
            'telp' => $fields['telp'],
            'level' => $fields['level']
        ]);

        $response = [
            'user' => $user,
            'message' => 'Petugas berhasil di create!'
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check username
        $username = People::where('username', $fields['username'])->first();

        // Check
        if(!$username){
            $username_officer = Officer::where('username', $fields['username'])->first();
            if(!$username_officer || !Hash::check($fields['password'], $username_officer->password)){
                return response()->json(['message' => "Gagal Login"], 401);
            }else{
                $response = [
                    'username' => $username_officer->username,
                    'id_petugas' => $username_officer->id_petugas,
                    'level' => $username_officer->level,
                    'message' => 'Berhasil Login'
                ];
            }
        }else{
            if(!Hash::check($fields['password'], $username->password)){
                return response()->json(['message' => "Gagal Login"], 401);
            }
            $response = [
                'username' => $username->username,
                'nik' => $username->nik,
                'level' => 'user',
                'message' => 'Berhasil Login'
            ];
        }

        return response()->json($response, 201);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function showDate(Request $request){
        $fields = $request->validate([
            'tanggal_dari' => 'required',
            'tanggal_sampai' => 'required'
        ]);

        $data = DB::table('complaints')->where('tanggal_laporan', '>=', $fields['tanggal_dari'])->where("tanggal_laporan", "<=", $fields["tanggal_sampai"])->get();

        return response()->json($data, 200);
   }
}

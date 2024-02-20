<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BanjirModel;


use DataTables;

class BanjirController extends Controller
{
    public function index()
    {
        return view('admin.banjir');
    }

    public function ajaxData(Request $request)
    {
        // Mendapatkan tahun dan bulan saat ini
        $tahunIni = date('Y');
        $bulanIni = date('m');

        $periode = $request->periode;

        // Data yang akan dikembalikan
        $filteredData = [];

        // Filter data berdasarkan periode yang dipilih
        if ($periode == 'tahun_ini') {
            // Filter data untuk tahun ini
            $filteredData = BanjirModel::whereYear('tanggal_banjir', $tahunIni)->get();
        } elseif ($periode == 'bulan_ini') {
            // Filter data untuk bulan ini
            $filteredData = BanjirModel::whereYear('tanggal_banjir', $tahunIni)
                ->whereMonth('tanggal_banjir', $bulanIni)
                ->get();
        } else {
            // Pilihan default, misalnya untuk menampilkan semua data
            $filteredData = BanjirModel::all();
        }

        // Kembalikan data yang telah difilter
        return $filteredData;
    }

    public function getList()
    {
        $data = BanjirModel::select('*')->orderBy('tanggal_banjir', 'desc')
            ->get();
        return DataTables::of($data)->make(true);
    }


    public function getEdit($id)
    {
        // Mengambil data bisnis berdasarkan ID
        $influencer = BanjirModel::find($id);

        // Memeriksa apakah bisnis ada
        if ($influencer) {
            // Mengembalikan respons JSON dengan detail bisnis
            return response()->json($influencer);
        } else {
            // Mengembalikan respons JSON dengan pesan kesalahan
            return response()->json(['error' => 'influencer not found.'], 404);
        }
    }
}

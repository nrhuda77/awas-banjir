<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HarianModel;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function ajaxData()
    {
        // Ambil data pendapatan dari model atau sumber data lainnya
        $harian = HarianModel::all();

        // Format data untuk digunakan dalam grafik area
        $labels = $harian->pluck('date_time')->map(function ($dateTime) {
            return date('M j H:i', strtotime($dateTime));
        })->toArray();
        $values = $harian->pluck('tinggi')->toArray();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}

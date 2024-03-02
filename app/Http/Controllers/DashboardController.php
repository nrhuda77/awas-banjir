<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HarianModel;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
{
    public function index()
    {
        $kodeHTML = $this->bacaHTML('https://www.bmkg.go.id/cuaca/prakiraan-cuaca.bmkg?Kota=Balikpapan&AreaID=501349&Prov=16');
        // Lakukan proses ekstraksi seperti yang Anda lakukan sebelumnya

        $pecah = explode('<h2 class="kota">', $kodeHTML);
        $waktu = explode('</h2>', $pecah[1]);
        // echo "<h2>" . $pecahLagi[0] . "</h2>";

        $pecah2 = explode('<h2 class="heading-md">', $kodeHTML);
        $temperatur = explode('</h2>', $pecah2[1]);
        // echo "<h2>" . $pecahLagi2[0] . "</h2>";

        $pecah3 = explode('<p>', $kodeHTML);
        $cuaca = explode('</p>', $pecah3[1]);
        // echo "<h2>" . $pecahLagi3[0] . "</h2>";


        $air = explode('</p>', $pecah3[2]);
        // Setel variabel cuaca yang akan digunakan di view
        $cuacaStatus = strpos($cuaca[0], 'Hujan') !== false ? 'Hujan' : (strpos($cuaca[0], 'Berawan') !== false ? 'Berawan' : 'Cerah');
        $data = [
            'cuacaStatus' => $cuacaStatus,
            'waktu' => $waktu,
            'temperatur' => $temperatur,
            'cuaca' => $cuaca,
            'air' => $air
        ];
        return view('admin.index', $data);
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

    function bacaHTML($url)
    {
        // inisialisasi CURL
        $data = curl_init();
        // setting CURL
        curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($data, CURLOPT_URL, $url);
        // menjalankan CURL untuk membaca isi file
        $hasil = curl_exec($data);
        curl_close($data);
        return $hasil;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BanjirModel;
use App\Models\HarianModel;
use App\Models\checkModel;
use App\Models\UmumModel;
use App\Models\InfluencerModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $Banjir = BanjirModel::find($id);

        // Memeriksa apakah bisnis ada
        if ($Banjir) {
            // Mengembalikan respons JSON dengan detail bisnis
            return response()->json($Banjir);
        } else {
            // Mengembalikan respons JSON dengan pesan kesalahan
            return response()->json(['error' => 'Banjir not found.'], 404);
        }
    }

    public function apiBanjir(Request $request)
{
    date_default_timezone_set("Asia/Kuala_Lumpur");

    $data = CheckModel::first(); // Retrieve the first record from the database
    $nextInsert = $data->next_insert; // timestamp type
    $time = date('Y-m-d H:i:s');
    $date = date('Y-m-d');

    if ($time >= $nextInsert) {
        $tinggi = $request->tinggi;
        $data->tinggi = $tinggi;
        HarianModel::create(['tinggi' => $tinggi, 'date_time' => $time]); // Menggunakan waktu saat ini untuk insert

        if ($tinggi <= 300) {
            BanjirModel::create(['tanggal_banjir' => $date, 'wa' => 0, 'awal_banjir' => $time, 'status' => 0]);
        }
        $newDate = date("Y-m-d H:i:s", strtotime($nextInsert . " +10 minutes"));

        // Perbarui waktu untuk insert berikutnya
        $data->update(['next_insert' => $newDate]);
        return response()->json(['status' => true]);
    } else {
        return response()->json(['status' => false, 'message' => 'Belum waktunya untuk insert']);
    }
}
    public function apiPhoto(Request $request)
    {
        $data = BanjirModel::where('status', 0)->first();

        if ($data) {

            // Lakukan penyimpanan foto dari $request->foto
            // if ($request->hasFile('image')) {
            //     $foto = $request->image;

            //     // Generate nama file baru (misalnya, menggunakan timestamp)
            //     $namaFile = time() . '_' . $foto->getClientOriginalName();

            //     // Simpan foto dengan nama file baru
            //     Storage::disk('public')->put($namaFile, $foto);

            //     // Perbarui kolom 'foto' pada BanjirModel dengan path foto yang baru
            //     $data->update(['foto' => $namaFile]);
            // }

            $image = $request->image;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10).'.'.'png';
            Storage::disk('public')->put($imageName, base64_decode($image));
            $data->update(['foto' => $imageName]);

            $influencers = InfluencerModel::all();
            foreach ($influencers as $influencer) {
                $this->waApi($influencer['no_wa']);
            }

            // Setelah menyimpan foto, Anda mungkin juga perlu memperbarui status BanjirModel menjadi 1
            $data->update(['wa' => 1, 'status' => 1]);

            return response()->json(['status' => true, 'message' => 'Foto berhasil disimpan']);
        } else {
            return response()->json(['status' => false, 'message' => 'Tidak ada data dengan status 0']);
        }
    }

    public function waApi($wa)
    {
        $data = UmumModel::find(1);
        $message = $data['description_wa'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $wa,
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ToQ_4#3Nmzxi##xXbABV' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }
        echo $response;
    }


    public function closeBanjir()
    {
        $banjir = BanjirModel::where('status', 1)->first();

        // Periksa apakah ada banjir dengan status 1
        if ($banjir) {
            // Ambil maksimum tinggi yang ada di database
            $maxTinggi = HarianModel::max('tinggi');

            // Ambil waktu surut dengan tinggi lebih besar atau sama dengan 400 dan setelah waktu awal banjir
            $jamSurut = HarianModel::where('tinggi', '>=', 400)
                ->where('date_time', '>=', $banjir->awal_banjir)
                ->first();

            // Update kolom 'tinggi', 'status', dan 'akhir_banjir' pada BanjirModel

            $banjir->update([
                'tinggi' => $maxTinggi,
                'status' => 2,
                'akhir_banjir' => $jamSurut->date_time
            ]);


            // Hapus semua data harian
            HarianModel::truncate();
        }
    }
}

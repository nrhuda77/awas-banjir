<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfluencerModel;

use DataTables;

class InfluencerController extends Controller
{
    public function index()
    {
        return view('admin.influencer');
    }

    public function getList()
    {
        $data = InfluencerModel::select('*')
            ->get();
        return DataTables::of($data)->make(true);
    }

    public function getEdit($id)
    {
        // Mengambil data bisnis berdasarkan ID
        $influencer = InfluencerModel::find($id);

        // Memeriksa apakah bisnis ada
        if ($influencer) {
            // Mengembalikan respons JSON dengan detail bisnis
            return response()->json($influencer);
        } else {
            // Mengembalikan respons JSON dengan pesan kesalahan
            return response()->json(['error' => 'influencer not found.'], 404);
        }
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'no_wa' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $influencer = InfluencerModel::create([
            'nama' => $request->input('nama'),
            'no_wa' => $request->input('no_wa'),
            'pekerjaan' => $request->input('pekerjaan')
        ]);

        return response()->json(['status' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'no_wa' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $influencer = InfluencerModel::find($request->input('id'));

        if (!$influencer) {
            return response()->json(['status' => false], 404);
        }

        $influencer->update([
            'nama' => $request->input('nama'),
            'no_wa' => $request->input('no_wa'),
            'pekerjaan' => $request->input('pekerjaan')
        ]);

        return response()->json(['status' => true]);
    }

    public function delete($id)
    {
        $influencer = InfluencerModel::find($id);

        if (!$influencer) {
            return response()->json(['status' => false], 404);
        }

        $influencer->delete();

        return response()->json(['status' => true]);
    }
}

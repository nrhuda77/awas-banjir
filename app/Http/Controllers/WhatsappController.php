<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UmumModel;

class WhatsappController extends Controller
{
    public function index()
    {
        $data = [
            'whatsapp' => UmumModel::find(1)
        ];
        return view('admin.whatsapp', $data);
    }

    public function save(Request $request)
    {
        $request->validate([

            'description_wa' => 'required|string',
        ]);

        $whatsapp = UmumModel::find($request->input('id'));

        if (!$whatsapp) {
            return response()->json(['status' => false], 404);
        }

        $whatsapp->update([
            'description_wa' => $request->input('description_wa')
        ]);

        return response()->json(['status' => true]);
    }
}

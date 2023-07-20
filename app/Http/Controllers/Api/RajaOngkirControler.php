<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirControler extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json([
            'success'   => true,
            'message'   => 'list data province',
            'data'      => $provinces
        ]);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('province_id', $request->province_id)->get();
        return response()->json([
            'success'   => true,
            'message'   => 'list data city by province',
            'data'      => $cities
        ]);
    }

    public function checkOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key'   => config('services.rajaongkir.key')
        ])->post('https://api.rajaongkir.com/starter/cost', [
            // send data
            'origin'    => 113, //contoh
            'destination'   => $request->city_destination,
            'weight'        => $request->weight,
            'courier'       => $request->courier
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'List data alla courier : ' . $request->courier,
            'data'      => $response['rajaongkir']['results'][0]
        ]);
    }
}

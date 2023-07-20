<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use PSpell\Config;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key'   => Config('services.rajaongkir.key')
        ])->get('https://api.rajaongkir.com/starter/city');

        foreach ($response['rajaongkir']['results'] as $city) {
            City::create([
                'province_id'   => $city['province_id'],
                'city_id'       => $city['city_id'],
                'name'          => $city['city_name'] . ' - ' . '(' . $city['type'] . ')',
            ]);
        };
    }
}

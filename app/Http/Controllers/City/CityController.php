<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\SearchedCities;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getSearchedCities(Request $request)
    {
        return Response(SearchedCities::select('cities.city_name')
            ->join('cities', 'cities.id', 'searched_cities.city_id')
            ->where('searched_cities.user_id', $request->user()->id)
            ->get()
        );
    }

    public function saveSearchedCity(Request $request)
    {
        $city = Cities::firstOrCreate(
            ['city_name' => strtolower($request->city_name)],
            ['city_name' => strtolower($request->city_name)]
        );

        SearchedCities::firstOrCreate([
            'user_id' => $request->user()->id,
            'city_id' => $city->id,
        ], [
            'user_id' => $request->user()->id,
            'city_id' => $city->id,
        ]);
    }

    public function removeSearchedCity(Request $request)
    {
        $city_id = Cities::select('id')
            ->where('city_name', strtolower($request->city_name))
            ->value('id');

        return Response(SearchedCities::where('user_id', $request->user()->id)
            ->where('city_id', $city_id)
            ->delete());
    }
}

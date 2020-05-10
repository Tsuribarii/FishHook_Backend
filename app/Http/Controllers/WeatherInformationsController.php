<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherInformation;

class WeatherInformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function weather()
    {
        $weather = WeatherInformation::all();
        return response()->json(
            $weather
        );
        var_dump($datas);
    }
    //json -> database 저장함수  
    public function weather_json()
    {
        //json 가져오기
        $path = 'C:\Users\PC\jekim\FishHook_Weather\weather.json';
        $json = trim(file_get_contents($path), "\xEF\xBB\xBF");
        $datas = json_decode($json, true);  
        // key, value 지정
        $json = [];
        for ($i=0; $i < count((is_countable($datas) ? $datas : [])); $i++) {
            $kk = array(
                'location'   => $datas[$i][0],
                'temperature' => $datas[$i][1],
                'humidity'  => $datas[$i][2],
                'wind_direction'  => $datas[$i][3]
            );
            array_push($json, $kk);
        }
        // 모델 가져오기
        $weather = new WeatherInformation();
        // 키밸류로 만든 array를 돌려서 데이터베이스에 삽입
        foreach ($json as $res) {
            $weather->location      = $res['location'];
            $weather->temperature      = $res['temperature'];
            $weather->humidity    = $res['humidity'];
            $weather->wind_direction     = $res['wind_direction'];
            $weather->save();
            $weather = new WeatherInformation();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

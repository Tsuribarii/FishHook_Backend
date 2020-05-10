<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TideInformation;

class TideInformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function tide()
    {
        $path = 'C:\Users\PC\jekim\FishHook_HighTide\HighTide.json';
        $datas = json_decode(file_get_contents($path), true);
        $data = array_filter($datas, function($value) {
            $location = request('location');
            return $value[0] == $location;
        });
        return $data;
                
    }
    public function tide_json()
    {
        //json 가져오기
        $path = 'C:\Users\PC\jekim\FishHook_HighTide\HighTide.json';
        $datas = json_decode(file_get_contents($path), true);
        // key, value 지정
        $json = [];
        for ($i=0; $i < count($datas); $i++) {
            $kk = array(
                'location'   => $datas[$i][0],
                'date' => $datas[$i][1],
                'hide_tide'  => $datas[$i][2]
            );
            array_push($json, $kk);
        }
        // 모델 가져오기
        $tide = new TideInformation();
        // 키밸류로 만든 array를 돌려서 데이터베이스에 삽입
        foreach ($json as $res) {
            $tide->location = $res['location'];
            $tide->date = $res['date'];
            $tide->hide_tide = $res['hide_tide'];
            $tide->save();
            $tide = new TideInformation();
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
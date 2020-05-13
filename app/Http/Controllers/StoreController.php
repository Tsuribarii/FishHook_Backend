<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\functions\storelocator;
use Illuminate\Support\Facades\DB;
use App\Store;
use DOMDocument;

class StoreController extends Controller
{
    public function show(Request $request){

        $center_lat = $request->latitude;
        $center_lng = $request->longitude;
        $radius = $request->radius;

        // XML 파일을 시작하고 부모 노드를 만듭니다.
        $dom = new DOMDocument("1.0");
        $node = $dom->createElement("markers");
        $parnode = $dom->appendChild($node);

        $query = DB::table('stores')
            ->select('id', 'name', 'address', 'latitude', 'longitude',
                DB::raw( "
                        3959 * acos(
                            cos(radians($center_lat)) *
                            cos(radians(latitude)) * 
                            cos(radians(longitude) - radians($center_lng)) +
                            sin(radians($center_lat)) *
                            sin(radians(latitude))
                        )
                      AS distance"
                ) 
            )
            // ->havingRaw('distance <'.$radius)
            ->orderbyRaw('distance')
            ->get();

        // header("Content-type: text/xml; charset=euc-kr");

        $count = count($query);

        for($i=0; $i<=$count-1; $i++){
            $node = $dom->createElement("marker");
            $newnode = $parnode->appendChild($node);
            $newnode->setAttribute("id", $query[$i]->id);
            $newnode->setAttribute("name", $query[$i]->name);
            $newnode->setAttribute("address", $query[$i]->address);
            $newnode->setAttribute("latitude", $query[$i]->latitude);
            $newnode->setAttribute("longitude", $query[$i]->longitude);
            $newnode->setAttribute("distance", $query[$i]->distance);
        }
        // dd($newnode);
        return $dom->saveXML();
            // ->header("Content-type: text/xml; charset=euc-kr");
    }

}

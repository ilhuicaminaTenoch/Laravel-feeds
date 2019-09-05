<?php

namespace App\Http\Controllers;

use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postRequest()
    {
        $utils = new Utils();
        $nameLocal = 'enVivo.json';
        $nameProduccion = '/app_programs/tudn/test/events_all.json';
        $postFields = "{\"query\":\"{\\n  programs(uid:\\\"0000016b-fccb-d523-a5fb-ffcf50890000\\\",pagina:\\\"/app-feed-home\\\",ui:\\\"tudn\\\"){\\n    id\\n    name\\n    description\\n    pub_date\\n    start_time\\n    end_time\\n    is_live\\n    image_assets{\\n      image_base\\n    }\\n    show_category_external_id\\n    channel_id\\n    channel_name\\n    override_url\\n    stream_state\\n    url_public\\n    type\\n  }\\n}\",\"variables\":null}";
        $dataProduccionString = $utils->curlGql('http://localhost:3000/api','3000', $postFields);
        if (!Storage::disk('public')->exists($nameLocal)){
            Storage::disk('public')->put($nameLocal,'');
        }
        $dataLocalString = Storage::disk('public')->get($nameLocal);
        if (strcmp($dataProduccionString, $dataLocalString) !== 0){
            //echo"el contenido de produccion NO es igual al contenido de local";
            $data = json_decode($dataProduccionString,true);
            $programs = json_encode($data['data'], true);
            Storage::disk('public')->put($nameLocal,$dataProduccionString);
            Storage::disk('NETSTORAGE1')->put($nameProduccion, $programs);
            Storage::disk('NETSTORAGE2')->put($nameProduccion, $programs);
            $fastPurge = $utils->fastPurgeAkamai('http://static-feeds.esmas.com/awsfeeds'.$nameProduccion);

        }else{
            //echo"el contenido de produccion es igual al contenido de local";
        }
        return $fastPurge;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

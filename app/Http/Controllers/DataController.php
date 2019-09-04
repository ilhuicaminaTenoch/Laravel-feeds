<?php

namespace App\Http\Controllers;

use GraphQL\Client;
use GraphQL\Exception\QueryError;
use GraphQL\Query;
use GraphQL\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postRequest()
    {
        $client = new Client(
            'http://localhost:3000/api'
        );
        $gql = (new Query('getEnVivo'))
            ->setSelectionSet(
                [
                    'name',
                    'promoType'
                ]
            );

        try {
            $results = $client->runQuery($gql, true, [
                'uid' => '0000016b-fccb-d523-a5fb-ffcf50890000',
                'pagina' => '/app-feed-home',
                'ui' => 'tudn'
            ]);
            echo"ENTRO AQUI<pre>"; print_r($results); echo"</pre>";
        }
        catch (QueryError $exception) {
            print_r($exception->getErrorDetails());
            exit;
        }
        return ['ok'];
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

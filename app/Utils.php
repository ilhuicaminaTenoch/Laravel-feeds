<?php

namespace App;

use Akamai\Open\EdgeGrid\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Utils extends Model
{
    public function curlGql(string $endPoint, string $port, string $postFields){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => $port,
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "accept-encoding: gzip, deflate, br",
                "accept-language: es-ES,es;q=0.9,en;q=0.8",
                "cache-control: no-cache",
                "connection: keep-alive",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::channel('deportes')->error("cURL Error GraphQL: $err");
            throw new \App\Exceptions\CustomException("cURL Error GraphQL: " . $err);

        } else {
            $data = $response;
        }
        return $data;
    }

    public function fastPurgeAkamai(string $url){
        $result = [];
        try{
            $cliente = new Client([
                'base_uri' => env('AKAMAI_BASE'),
                'verify' => false
            ]);

            $cliente->setAuth(env('CLIENT_TOKEN'), env('CLIENT_SECRET'), env('ACCES_TOKEN'));
            $respuesta = $cliente->request('POST','/ccu/v3/invalidate/url/production', ['json' => ['objects' => [$url]]]);
            $code = $respuesta->getStatusCode();
            $respuesta = json_decode($respuesta->getBody());

            $resultado = array(
                'response' => $respuesta->httpStatus,
                'time' => $respuesta->estimatedSeconds,
                'url' => $url
            );
        }catch (RequestException $exception){
            $error = Psr7\str($exception->getRequest());
            throw new \App\Exceptions\CustomException($error);
            if ($exception->hasResponse()){
                $error = Psr7\str($exception->getResponse());
                throw new \App\Exceptions\CustomException($error);
            }
        }
        return $resultado;
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class consumirMarvelController extends Controller {

    public function index(Request $Request) {
        try {

            $titleId = $Request->all();

            // Verifica se o valor passao é numérico ou uma string, caso for o prefixo vai ser definico para procurar um id se não vai procurar um título

            if (is_numeric($titleId['titleId'])) {
                $prefix = '/' . $titleId['titleId'];
            } else {
                $prefix = '?title=' . $titleId['titleId'];
            }

            $date = date_create();
            $timestamps = date_timestamp_get($date);
            $apiKeyPublic = '53ba98862d7d43f30ce5398d47c95c35';
            $apiKeyPrivate = '6b85a91776480478315ebb4d94f86a7da13929d1';
            $hash = md5($timestamps . $apiKeyPrivate . $apiKeyPublic);
            $keyToken = "&ts={$timestamps}&apikey={$apiKeyPublic}&hash={$hash}";
            $url = "http://gateway.marvel.com/v1/public/comics{$prefix}{$keyToken}";
            $response = Http::get($url)->json();

            $dadosComics = [];
            forEach ($response['data']['results'] as $key => $value) {
                $dadosComics[$key][] = $response['data']['results'][$key]['id'];
                $dadosComics[$key][] = $response['data']['results'][$key]['title'];
                $dadosComics[$key][] = $response['data']['results'][$key]['description'];
                $dadosComics[$key][] = $response['data']['results'][$key]['urls'];
                $dadosComics[$key][] = $response['data']['results'][$key]['thumbnail'];
                $dadosComics[$key][] = $response['data']['results'][$key]['images'];
            }
            return response()->json($dadosComics);
        } catch (Exception $e) {
//             return response()->json($params, 400);
        }
    }

}

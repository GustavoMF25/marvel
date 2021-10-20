<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class consumirMarvelController extends Controller {

    public function BuscaTitleId($titleId) {
        try {
            // Verifica se o valor passao é numérico ou uma string, caso for o prefixo vai ser definico para procurar um id se não vai procurar um título
            if (is_numeric($titleId)) {
                $prefix = '/' . $titleId;
            } else {
                $prefix = '?title=' . $titleId;
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
                $dadosComics[$key][] = $response['data']['results'][$key]['ean'];
                $dadosComics[$key][] = $response['data']['results'][$key]['prices'];
                $dadosComics[$key][] = $response['data']['results'][$key]['images'];
            }
            // Ferifica se existe comics de acordo com o title ou id pedidos
            if (count($dadosComics) > 1) {
                // se existir retorna os comics
                return response()->json($dadosComics);
            } else {
                // se não existir retornará uma mensagem de error
                $dadosComics = [
                    'sucesso' => false,
                    "mensagem" => 'Comics não encontrada',
                ];
                return response()->json([$dadosComics]);
            }
        } catch (Exception $e) {
            $dadosComics = [
                'sucesso' => false,
                "mensagem" => $e,
            ];
            return response()->json([$dadosComics]);
        }
    }

}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Models\Quadrinhos;
use App\Models\User;

class consumirMarvelController extends Controller {

    public function index() {
        //
    }

    public function BuscaTitleId($titleId) {
        try {

            // Verifica se o valor passao é numérico ou uma string, caso for o prefixo vai ser definico para procurar um id se não vai procurar um título
            if (is_numeric($titleId)) {
                $prefix = '/' . $titleId . '?';
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
            // Verifica se existe algum item encontrado
            if (intval($response['data']['count']) > 0) {
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
                return response()->json($dadosComics);
            } else {
                $informações = [
                    "error" => true,
                    "mensagem" => 'Comics não encontrada!',
                ];
                return response()->json($informações);
            }
        } catch (Exception $e) {
            $informações = [
                "error" => true,
                "mensagem" => 'Error: ' . $e,
            ];
            return response()->json($informações);
        }
    }

    public function StoreUltimaSemana() {
//        https://gateway.marvel.com:443/v1/public/comics?dateDescriptor=lastWeek&apikey=
        $date = date_create();
        $timestamps = date_timestamp_get($date);
        $apiKeyPublic = '53ba98862d7d43f30ce5398d47c95c35';
        $apiKeyPrivate = '6b85a91776480478315ebb4d94f86a7da13929d1';
        $hash = md5($timestamps . $apiKeyPrivate . $apiKeyPublic);
        $keyToken = "&ts={$timestamps}&apikey={$apiKeyPublic}&hash={$hash}";
        $url = "https://gateway.marvel.com:443/v1/public/comics?dateDescriptor=lastWeek{$keyToken}";
        $response = Http::get($url)->json();

        $error = [];
        $contError = 0;
        $contSucesso = 0;

        // Verifica se existe algum item encontrado
        if (intval($response['data']['count']) > 0) {
            Quadrinhos::truncate();
            forEach ($response['data']['results'] as $key => $value) {
                $dadosIdComics = $response['data']['results'][$key]['id'];
                $dadosTitle = $response['data']['results'][$key]['title'];
                $dadosDescription = $response['data']['results'][$key]['description'];
                $dadosUrls = json_encode($response['data']['results'][$key]['urls']);
                $dadosThumbnail = json_encode($response['data']['results'][$key]['thumbnail']);
                $dadosEan = $response['data']['results'][$key]['ean'];
                $dadosPrices = json_encode($response['data']['results'][$key]['prices']);
                $dadosImages = json_encode($response['data']['results'][$key]['images']);

                $verificaIdComics = Quadrinhos::where("idComics", $dadosIdComics)
                        ->select('idComics')
                        ->first();
                if (is_null($verificaIdComics)) {
                    $quadrinho = new Quadrinhos;
                    $quadrinho->idComics = $dadosIdComics;
                    $quadrinho->title = $dadosTitle;
                    $quadrinho->description = $dadosDescription;
                    $quadrinho->url = $dadosUrls;
                    $quadrinho->thumbnail = $dadosThumbnail;
                    $quadrinho->ean = $dadosEan;
                    $quadrinho->prices = $dadosPrices;
                    $quadrinho->images = $dadosImages;

                    $quadrinho->save();
                    $contSucesso++;
                } else {
                    $contError++;
                    $error [] = [
                        "idComics" => $verificaIdComics->idComics,
                    ];
                }
            }

            $informações = [
                "error" => $error,
                "repetidos" => $contError,
                "salvos" => $contSucesso
            ];

            return response()->json($informações);
        }
    }

}

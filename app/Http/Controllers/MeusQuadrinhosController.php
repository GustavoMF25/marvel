<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeusQuadrinhosController extends Controller {

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $dados = $request->all()['Comics'];



        $dadosIdComics = $dados['Comics'][0];
        $dadosTitle = $dados['data'][1];
        $dadosDescription = $dados[2]['Comics'][$key]['description'];
        $dadosUrls = json_encode($dados['data']['results'][$key]['urls']);
        $dadosThumbnail = json_encode($dados['data']['results'][$key]['thumbnail']);
        $dadosEan = $dados['Comics']['results'][$key]['ean'];
        $dadosPrices = json_encode($dados['data']['results'][$key]['prices']);
        $dadosImages = json_encode($dados['data']['results'][$key]['images']);

//        $verificaIdComics = Quadrinhos::where("idComics", $dadosIdComics)
//                ->select('idComics')
//                ->first();
//        if (is_null($verificaIdComics)) {
//            $guadrinho = new Quadrinhos;
//            $guadrinho->idComics = $dadosIdComics;
//            $guadrinho->title = $dadosTitle;
//            $guadrinho->description = $dadosDescription;
//            $guadrinho->url = $dadosUrls;
//            $guadrinho->thumbnail = $dadosThumbnail;
//            $guadrinho->ean = $dadosEan;
//            $guadrinho->prices = $dadosPrices;
//            $guadrinho->images = $dadosImages;
//
//            $guadrinho->save();
//            $contSucesso++;
//        } else {
//            $contError++;
//            $error [] = [
//                "idComics" => $verificaIdComics->idComics,
//            ];
//        }
    }

    public function show($id) {
        //
    }

    public function destroy($id) {
        //
    }

}

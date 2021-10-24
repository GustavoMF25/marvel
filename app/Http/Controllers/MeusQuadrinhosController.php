<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\MeusQuadrinhos;
use App\Http\Controllers\api\consumirMarvelController;

class MeusQuadrinhosController extends Controller {

    public function index() {
        $quadrinhos = MeusQuadrinhos::all();
        $dadosQuadrinhos = [];
        foreach ($quadrinhos as $key => $value) {
            $dadosQuadrinhos[$key][] = $value->idComics;
            $dadosQuadrinhos[$key][] = $value->title;
            $dadosQuadrinhos[$key][] = $value->description;
            $dadosQuadrinhos[$key][] = json_decode($value->url, true);
            $dadosQuadrinhos[$key][] = json_decode($value->thumbnail, true);
            $dadosQuadrinhos[$key][] = $value->ean;
            $dadosQuadrinhos[$key][] = json_decode($value->prices, true);
            $dadosQuadrinhos[$key][] = json_decode($value->images, true);
            $dadosQuadrinhos[$key][] = $value->comentario;
        }

        return view('meusQuadrinhos', ['data' => $dadosQuadrinhos]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        try {
            $result = $request->all();
            $dados = consumirMarvelController::BuscaTitleId($result['idComics']);
            $comics = $dados->getData();
            $dadosComics = [];
            $user = auth()->user();
            $dadosIdComics = $comics[0][0];
            $dadosTitle = $comics[0][1];
            $dadosDescription = $comics[0][2];
            $dadosUrls = json_encode($comics[0][3]);
            $dadosThumbnail = json_encode($comics[0][4]);
            $dadosEan = $comics[0][5];
            $dadosPrices = json_encode($comics[0][6]);
            $dadosImages = json_encode($comics[0][7]);

            $meusQuadrinhos = new MeusQuadrinhos;
            $verificaExist = MeusQuadrinhos::where('idComics', $comics[0][0])
                    ->select('idComics')
                    ->first();
            if (is_null($verificaExist)) {
                $meusQuadrinhos->user_id = $user->id;
                $meusQuadrinhos->idComics = $dadosIdComics;
                $meusQuadrinhos->title = $dadosTitle;
                $meusQuadrinhos->description = $dadosDescription;
                $meusQuadrinhos->url = $dadosUrls;
                $meusQuadrinhos->thumbnail = $dadosThumbnail;
                $meusQuadrinhos->ean = $dadosEan;
                $meusQuadrinhos->prices = $dadosPrices;
                $meusQuadrinhos->images = $dadosImages;

                $meusQuadrinhos->save();
                $informações = [
                    "error" => false,
                    "mensagem" => "Comics salva com sucesso!!",
                ];
                return response()->json($informações);
            } else {
                $informações = [
                    "error" => true,
                    "mensagem" => "Comics já está salva!!",
                ];
                return response()->json($informações);
            }
        } catch (Exception $e) {
            $informações = [
                "error" => true,
                "mensagem" => "Error: " . $e,
            ];
            return response()->json($informações);
        }
    }

    public function show($id) {
        //
    }

    public function destroy(Request $id) {
        $response = $id->all();

        $comics = MeusQuadrinhos::where('idComics', $response['idComics'])
                ->get();
        if (count($comics) > 0) {
            foreach ($comics as $item) {
                MeusQuadrinhos::destroy($item->id);
            }
            $informações = [
                "error" => false,
                "mensagem" => 'Comics excluida da sua lista!',
            ];

            $quadrinhos = MeusQuadrinhos::all();
            $dadosQuadrinhos = [];
            foreach ($quadrinhos as $key => $value) {
                $dadosQuadrinhos[$key][] = $value->idComics;
                $dadosQuadrinhos[$key][] = $value->title;
                $dadosQuadrinhos[$key][] = $value->description;
                $dadosQuadrinhos[$key][] = json_decode($value->url, true);
                $dadosQuadrinhos[$key][] = json_decode($value->thumbnail, true);
                $dadosQuadrinhos[$key][] = $value->ean;
                $dadosQuadrinhos[$key][] = json_decode($value->prices, true);
                $dadosQuadrinhos[$key][] = json_decode($value->images, true);
            }

            return view('meusQuadrinhos', ['error' => json_encode($informações), 'data' => $dadosQuadrinhos]);
        } else {

            $quadrinhos = MeusQuadrinhos::all();
            $dadosQuadrinhos = [];
            foreach ($quadrinhos as $key => $value) {
                $dadosQuadrinhos[$key][] = $value->idComics;
                $dadosQuadrinhos[$key][] = $value->title;
                $dadosQuadrinhos[$key][] = $value->description;
                $dadosQuadrinhos[$key][] = json_decode($value->url, true);
                $dadosQuadrinhos[$key][] = json_decode($value->thumbnail, true);
                $dadosQuadrinhos[$key][] = $value->ean;
                $dadosQuadrinhos[$key][] = json_decode($value->prices, true);
                $dadosQuadrinhos[$key][] = json_decode($value->images, true);
            }

            $informações = [
                "error" => true,
                "mensagem" => 'Comics não encontrada na sua lista',
            ];
            return view('meusQuadrinhos', ['error' => json_encode($informações), 'data' => $dadosQuadrinhos]);
        }
    }

}

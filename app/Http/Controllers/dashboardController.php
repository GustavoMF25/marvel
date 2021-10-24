<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\api\consumirMarvelController;
use App\Models\Models\MeusQuadrinhos;

class dashboardController extends Controller {

    public function index() {
        return view('dashboard');
    }

    public function show(Request $request) {
        $dados = $request->all();
        if (isset($dados['valorTitleId']) || $dados['valorTitleId'] != null) {
            $result = consumirMarvelController::BuscaTitleId($dados['valorTitleId']);
            $dados = $result->getData();

            if (!isset($dados->error)) {
                return view('dashboard', ['data' => $dados]);
            } else {
                return view('dashboard', ['error' => json_encode($dados)]);
            }
        } else {
            $informações = [
                "error" => true,
                "mensagem" => 'Não foi digitado nenhuma informação',
            ];
            return view('dashboard', ['error' => json_encode($informações)]);
        }
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

}

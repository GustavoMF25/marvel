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
            $dadosQuadrinhos[$key][] = $value->comentar;
            $dadosQuadrinhos[$key][] = $value->id;
        }

        return view('meusQuadrinhos', ['data' => $dadosQuadrinhos]);
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
                $informa????es = [
                    "error" => false,
                    "mensagem" => "Comics salva com sucesso!!",
                ];
                return response()->json($informa????es);
            } else {
                $informa????es = [
                    "error" => true,
                    "mensagem" => "Comics j?? est?? salva!!",
                ];
                return response()->json($informa????es);
            }
        } catch (Exception $e) {
            $informa????es = [
                "error" => true,
                "mensagem" => "Error: " . $e,
            ];
            return response()->json($informa????es);
        }
    }

    public function destroy(Request $id) {
        $response = $id->all();

        $comics = MeusQuadrinhos::where('idComics', $response['idComics'])
                ->get();
        if (count($comics) > 0) {
            foreach ($comics as $item) {
                MeusQuadrinhos::destroy($item->id);
            }
            $informa????es = [
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
                $dadosQuadrinhos[$key][] = $value->comentar;
                $dadosQuadrinhos[$key][] = $value->id;
            }

            return view('meusQuadrinhos', ['error' => json_encode($informa????es), 'data' => $dadosQuadrinhos]);
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
                $dadosQuadrinhos[$key][] = $value->comentar;
                $dadosQuadrinhos[$key][] = $value->id;
            }

            $informa????es = [
                "error" => true,
                "mensagem" => 'Comics n??o encontrada na sua lista',
            ];
            return view('meusQuadrinhos', ['error' => json_encode($informa????es), 'data' => $dadosQuadrinhos]);
        }
    }

    public function update(Request $request) {

        $response = $request->all();
        $comics = MeusQuadrinhos::find($response['id']);
        $comics->comentar = $response['comentario'];
        $update = $comics->update();
        if ($update) {
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
                $dadosQuadrinhos[$key][] = $value->comentar;
                $dadosQuadrinhos[$key][] = $value->id;
            }
            $informacoes = [
                "error" => false,
                "mensagem" => 'Informa????es Atualizadas com sucesso!!!',
            ];
            return view('meusQuadrinhos', ['error' => json_encode($informacoes), 'data' => $dadosQuadrinhos]);
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
                $dadosQuadrinhos[$key][] = $value->comentar;
                $dadosQuadrinhos[$key][] = $value->id;
            }
            $informa????es = [
                "error" => true,
                "mensagem" => 'Falha ao atualizar as informa????es!!!',
            ];
            return view('meusQuadrinhos', ['error' => json_encode($informa????es), 'data' => $dadosQuadrinhos]);
        }
    }

    public function updateView(Request $request, $id) {
        $quadrinhos = MeusQuadrinhos::find($id)->toArray();
        return view('editMeusQuadrinhos', ['data' => $quadrinhos]);
    }

}

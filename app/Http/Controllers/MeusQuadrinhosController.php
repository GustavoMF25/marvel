<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\MeusQuadrinhos;

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
        }

        return view('meusQuadrinhos', ['data' => $dadosQuadrinhos]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        try {
            $dados = json_decode($request->all()['Comics'], true);
            $verificaIdComics = MeusQuadrinhos::where("idComics", $dados[0])
                    ->select('idComics')
                    ->first();

            if (!$verificaIdComics) {
                $user = auth()->user();
                $quadrinho = new MeusQuadrinhos;
                $quadrinho->user_id = $user->id;
                $quadrinho->idComics = $dados[0];
                $quadrinho->title = $dados[1];
                $quadrinho->description = $dados[2];
                $quadrinho->url = json_encode($dados[3]);
                $quadrinho->thumbnail = json_encode($dados[4]);
                $quadrinho->ean = $dados[5];
                $quadrinho->prices = json_encode($dados[6]);
                $quadrinho->images = json_encode($dados[7]);
                $quadrinho->save();

                $mensagem[0] = true;
                $mensagem[1] = 'Comics salva na sua lista!';
                return response()->json([$mensagem]);
            } else {
                $mensagem[0] = false;
                $mensagem[1] = 'Comics já está na sua lista';
                return response()->json([$mensagem]);
            }
        } catch (Exception $e) {
            $mensagem[0] = true;
            $mensagem[1] = 'Error: ' . $e;
            return response()->json([$mensagem]);
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
                "sucesso" => true,
                "mensagem" => 'Comics excluida da sua lista!',
            ];
            return response()->json($informações);
        } else {

            $informações = [
                "sucesso" => false,
                "mensagem" => 'Comics não encontrada na sua lista',
            ];
            return response()->json($informações);
        }
    }

}

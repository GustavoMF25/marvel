<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\api\consumirMarvelController;

class detalhesComicsController extends Controller {

    public function index(Request $request) {
        $dados = $request->all();
//        dd($dados);
        if (isset($dados['idComics']) || $dados['idComics'] != null) {
            $result = consumirMarvelController::BuscaTitleId($dados['idComics']);
            $dados = $result->getData();
            if ($dados[0][0] != false) {
                return view('verComics', ['data' => $dados]);
            } else {
                return view('verComics', ['error' => $dados]);
            }
        } else {
            return view('verComics', ['error' => ['sucesso' => false, 'mensagem' => 'Não foi digitado nenhuma informação']]);
        }
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

}

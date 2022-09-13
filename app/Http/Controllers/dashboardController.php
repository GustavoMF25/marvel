<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\api\consumirMarvelController;

class dashboardController extends Controller {

    public function index() {
        return view('dashboard');
    }

    public function buscaComics(Request $request) {
        $dados = $request->all();
        if (isset($dados['valorTitleId']) || $dados['valorTitleId'] != null) {
            $result = consumirMarvelController::BuscaTitleId($dados['valorTitleId']);
            $dados = $result->getData();
//            dd($dados);
            if ($dados[0][0] != false) {
                return view('dashboard', ['data' => $dados]);
            } else {
                return view('dashboard', ['error' => $dados]);
            }
        } else {
            return view('dashboard', ['error' => ['sucesso' => false, 'mensagem' => 'Não foi digitado nenhuma informação']]);
        }
//        
    }

}

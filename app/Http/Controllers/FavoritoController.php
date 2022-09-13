<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Quadrinhos;
use \App\Models\models\Favoritos;

class FavoritoController extends Controller {

    public function index() {
        $favoritos = Favoritos::all();


        dd($favoritos);
//        return view('meusFavoritos', compact('guadrinhos'));
    }

    public function store(Request $request) {
        $user = auth()->user();
        dd($request);
    }

    public function show($id) {
        //
    }

    public function destroy($id) {
        //
    }

}

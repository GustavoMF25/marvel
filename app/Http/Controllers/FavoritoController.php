<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Guadrinhos;

class FavoritoController extends Controller {

    public function index() {
        $guadrinhos = Guadrinhos::all();

        return view('meusFavoritos', compact('guadrinhos'));
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function destroy($id) {
        //
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Quadrinhos;

class QuadrinhoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $quadrinhos = Quadrinhos::all();
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

        return view('comicsDaSemana', ['data' => $dadosQuadrinhos]);
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

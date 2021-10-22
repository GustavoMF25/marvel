<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Guadrinhos;

class GuadrinhoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Guadrinhos::all();
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

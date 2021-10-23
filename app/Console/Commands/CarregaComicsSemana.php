<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\api\consumirMarvelController;

class CarregaComicsSemana extends Command {

    protected $signature = 'busca:semanacomics';
    protected $description = 'Busca as Comics/Quadrinhos da semana';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        consumirMarvelController::StoreUltimaSemana();
    }

}

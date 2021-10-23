<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuadrinhosTable extends Migration {

    public function up() {
        Schema::create('quadrinhos', function (Blueprint $table) {
            $table->id();
            $table->integer('idComics')->unique();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->json('url')->nullable();
            $table->json('thumbnail')->nullable();
            $table->string('ean')->nullable();
            $table->json('prices')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('quadrinhos');
    }

}

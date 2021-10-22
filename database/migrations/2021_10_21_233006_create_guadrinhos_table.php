<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuadrinhosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('guadrinhos', function (Blueprint $table) {
            $table->id();
            $table->integer('idComics')->unique();
            $table->string('title');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('guadrinhos');
    }

}

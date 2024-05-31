<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midia', function (Blueprint $table) {
            $table->id();
            $table->integer('TipoMidiaId')->default(1);
            $table->integer('OrigemMidiaId')->default(1);
            $table->string('Titulo', 255);
            $table->string('Resenha', 500)->nullable();
            $table->integer('AnexoId')->nullable();
            $table->integer('Avaliacao')->default(0);
            $table->datetime('Data')->nullable();
            $table->integer('UserId')->default(1);
            $table->boolean('Status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('midia');
    }
}

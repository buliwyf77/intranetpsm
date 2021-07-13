<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudVacacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_vacaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->date('fecha_inicio');
            $table->date('fecha_aprobacion');
            $table->date('fecha_rechazo');
            $table->date('fecha_culminacion');
            $table->date('fecha_reintegro');
            $table->integer('cantidad_dia');
            $table->integer('solicitud_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('solicitud_vacaciones');
    }
}

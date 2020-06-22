<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersAddLastName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('ruc');
            $table->text('dni_cedula');
            $table->text('last_name');
            $table->text('telefono');
            $table->text('celular_1');
            $table->text('celular_2');
            $table->integer('ciudad_id');
            $table->text('direccion_principal');
            $table->text('direccion_interseccion');
            $table->text('google_id');
            $table->text('facebook_id');
            $table->text('twitter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ruc');
            $table->dropColumn('dni_cedula');
            $table->dropColumn('last_name');
            $table->dropColumn('telefono');
            $table->dropColumn('celular_1');
            $table->dropColumn('celular_2');
            $table->dropColumn('ciudad_id');
            $table->dropColumn('direccion_principal');
            $table->dropColumn('direccion_interseccion');
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('twitter_id');
        });
    }
}

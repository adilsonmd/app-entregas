<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function($table){
            $table->foreign('id_entregador')->references('id')->on('entregadores')->onDelete('set null');
        });
        
        Schema::table('entregadores', function($table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::table('enderecos', function($table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::table('entregas', function($table) {
            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_entregador')->references('id')->on('entregadores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
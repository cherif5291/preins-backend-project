<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postulations', function (Blueprint $table) {
            $table->unsignedBigInteger('postulant_id');
            $table->foreign('postulant_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('secretaire_id');
            $table->foreign('secretaire_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('chefdep_id');
            $table->foreign('chefdep_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes');
            
            $table->string("Status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postulations', function (Blueprint $table) {
            $table->dropColumn(['postulant_id', 'secretaire_id', 'chefdep_id','Status']);
        });
    }
};

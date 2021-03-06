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
        Schema::create('utilisateur_comptes', function (Blueprint $table) {

            $table->unsignedBigInteger('id_compte');
            $table->unsignedBigInteger('id_user');
            $table->primary(['id_compte', 'id_user']);

            $table
                ->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table
                ->foreign('id_compte')
                ->references('id')
                ->on('comptes')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->boolean('editeur');

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
        Schema::dropIfExists('utilisateur_comptes');
    }
};

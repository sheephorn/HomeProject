<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TDocumentPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('t_document_places');
        Schema::create('t_document_places', function (Blueprint $table) {
            $table->integer('folder_id')->unsigned();
            $table->string('folder_name');
            $table->string('address');
            $table->integer('document_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['folder_id', 'address']);
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
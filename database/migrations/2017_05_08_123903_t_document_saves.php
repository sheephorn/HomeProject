<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TDocumentSaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('t_document_saves');
        Schema::create('t_document_saves', function (Blueprint $table) {
            $table->integer('document_id')->unsigned();
            $table->integer('homebudget_id')->unsigned();
            $table->string('title');
            $table->tinyInteger('important');
            $table->text('description');
            $table->date('save_limit');
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['document_id', 'homebudget_id']);
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

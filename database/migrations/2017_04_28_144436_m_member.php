<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('m_members');
        Schema::create('m_members', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->date('birth_date');
            $table->integer('home_id')->unsigned()->default(0);
            $table->string('email');
            $table->string('password');
            $table->mediumInteger('post_code');
            $table->tinyInteger('prefecture_id')->unsigned();
            $table->string('prefecture_name', 4);
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['email']);
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

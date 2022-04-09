<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessages123Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messagess', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->string('email');
            $table->string('post');
            $table->string('who _is_he');
            $table->string('id_client');
            $table->softDeletes();
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
        Schema::dropIfExists('messagess');
        
    }
}

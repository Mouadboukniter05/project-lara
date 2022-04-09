<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('check_id')->unsigned();
            $table->string('filename');
            $table->timestamps();
        });
        Schema::table('check_files', function (Blueprint $table) {
            $table->foreign('check_id')->references('id')->on('checks')->onDelete('cascade') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_files');
    
    }
}

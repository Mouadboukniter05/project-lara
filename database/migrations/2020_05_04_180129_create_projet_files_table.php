<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::create('projet_files', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('projet_id')->unsigned();
        $table->string('filename');
        $table->timestamps();
    });

    /*
    Delete files associated with Task ID
    */
    Schema::table('projet_files', function (Blueprint $table) {
        $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade') ;
    });

}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('projet_files');
}
}
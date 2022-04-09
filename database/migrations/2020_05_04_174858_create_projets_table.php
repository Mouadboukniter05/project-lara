<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetsTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned() ;
            $table->integer('customer_id')->unsigned();
            $table->string('projet_title');
            $table->text('projet') ;
            $table->integer('priority')->default(0) ;
            $table->boolean('completed')->default(0) ;          
            $table->softDeletes();
            $table->timestamps();
            $table->dateTime('duedate')->nullable();  
        });
        
        /*
        Delete tasks associated with this project ID
        */
        Schema::table('projets', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade') ;
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets');
    }
}

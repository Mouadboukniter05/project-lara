<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('coment')->nullable();
            $table->text('observation')->nullable();
            $table->double('amount',8,2);
            $table->string('bank');
            $table->string('location'); 
            $table->integer('priority')->default(0) ;
            $table->integer('completed')->default(0) ;
            $table->softDeletes();
            $table->timestamps();
            $table->dateTime('duedate')->nullable();    
        });
        
        /*
        Delete tasks associated with this project ID
        */
        Schema::table('checks', function (Blueprint $table) {
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
        Schema::dropIfExists('checks');
    }
}

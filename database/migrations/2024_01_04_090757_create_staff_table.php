<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Staff', function (Blueprint $table) {
            $table->id(); //primary key 
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('password');
            $table->string('whatsapp');
            $table->string('email')->unique();
            $table->string('nationality');
            $table->string('language_speak');
            $table->date('dob');
            $table->string('highest_education');
            $table->enum('documentation',['y','n']);
            $table->string('experience');
            $table->unsignedBigInteger('terms_and_conditions');
            $table->dateTime('accepted_time')->nullable();
            $table->timestamps();

            $table->foreign('terms_and_conditions')->references('id')->on('terms_and_conditions'); 

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}

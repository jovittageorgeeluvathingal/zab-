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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('password');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('nationality');
            $table->string('language_speak');

            $table->date('dob');
            $table->string('highest_education');
            $table->enum('documentation', ['Y', 'N']);
            $table->string('experience');
            $table->foreignId('terms_and_conditions_id')->constrained('terms_and_conditions');
            $table->timestamps();
            $table->dateTime('accepted_time')->nullable();

            #$table->boolean('active')->default(0);// new field active
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


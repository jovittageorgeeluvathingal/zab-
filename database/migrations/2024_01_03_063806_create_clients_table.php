<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('Name');
            $table->string('Email');
            $table->string('Phone');
            $table->string('Password');
            $table->string('Whatsapp');
            $table->string('Occupation');
            $table->string('Companyname');
            $table->foreignId('terms_and_conditions_id')->constrained('terms_and_conditions');
            $table->timestamps();
            $table->dateTime('accepted_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('whatsapp');
            $table->string('occupation');
            $table->string('companyname');
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
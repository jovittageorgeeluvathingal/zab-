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
            $table->id('staff_id');
            $table->string('Name');
            $table->string('Address');
            $table->string('Phone');
            $table->string('Password');
            $table->string('Whatsapp');
            $table->string('email');
            $table->string('nationality');
            $table->string('language_speak');
            $table->date('DOB');
            $table->string('Highest_education');
            $table->enum('Documentation', ['Y', 'N']);
            $table->string('Experience');
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
        Schema::dropIfExists('staff');
    }
}
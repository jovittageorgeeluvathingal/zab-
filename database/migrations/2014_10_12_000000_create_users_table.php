<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('Users_id'); // Renamed to Users_id
            $table->string('User_name', 255); // Changed 'name' to 'User_name' and set a length
            $table->string('Password'); // Changed 'password' to 'Password'
            $table->enum('Role', ['Admin'])->default('Admin'); // Added 'Role' field with default value 'Admin'
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
        Schema::dropIfExists('users');
    }
}
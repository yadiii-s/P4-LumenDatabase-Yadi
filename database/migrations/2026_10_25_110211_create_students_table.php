<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nim', 20);
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->text('address', 65535);
            $table->string('major', 100);
            $table->integer('semester');
            $table->enum('status', array('active', 'inactive', 'graduated'))->default('active');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}

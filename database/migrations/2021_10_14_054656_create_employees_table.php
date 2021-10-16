<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nationalID');
            $table->string('code')->nullable();
            $table->string('phone_number');
            $table->string('email');
            $table->string('dob');
            $table->enum('status',['ACTIVE','INACTIVE']);
            $table->enum('position',['MANAGER','DEVELOPER','DESIGNER','TESTER','DEVOPS']);
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
        Schema::dropIfExists('employees');
    }
}

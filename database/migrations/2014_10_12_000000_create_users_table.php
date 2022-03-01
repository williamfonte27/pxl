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
            $table->id();
            $table->string('name', 150);
            $table->string('address');
            $table->boolean('checked')->nullable();
            $table->longText('description');
            $table->string('interest', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email', 150);
            $table->string('account', 20);
            $table->string('credit_card_type', 25);
            $table->string('credit_card_number', 20);
            $table->string('credit_card_name', 100);
            $table->string('credit_card_expirationDate', 10);
            $table->string('file_name', 150);
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

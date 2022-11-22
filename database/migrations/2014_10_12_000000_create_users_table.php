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
            $table->string('account_id')->default(1);
            $table->string('accountLevel');
            $table->string('loginID');
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('currency')->default('MYR');
            $table->integer('credit_limit')->unsigned();
            $table->date('join_date');
            $table->string('created_by');
            $table->string('deleted_by')->nullable();
            $table->rememberToken();
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

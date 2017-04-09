<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 30)->unique();
            $table->string('email', 60)->unique();
            $table->string('password');
            $table->string('full_name', 60)->default('');
            $table->string('perfect_money', 30)->default('');
            $table->string('question')->default('');
            $table->string('answer')->default('');
            $table->integer('ref')->default(0);
            $table->string('come_from')->default('');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_admin')->default(0);
            $table->rememberToken();
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
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyUserTable extends Migration
{
    public function up()
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');

            $table->primary(['user_id', 'company_id']);
            $table->foreign('company_id')
                ->on('companies')
                ->references('id');
            $table->foreign('user_id')
                ->on('users')
                ->references('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_user');
    }
}

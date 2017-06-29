<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('label')->nullable();
            $table->string('lang')->nullable();
            $table->boolean('editable')->default(true);

            $table->string('type');

            $table->integer('group_param_id')->nullable();
            $table->string('group_col_name')->nullable();

            $table->text('value')->nullable();
            $table->text('meta')->nullable();

            $table->integer('created_by_user_id')->nullable();
            $table->integer('updated_by_user_id')->nullable();
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
        Schema::dropIfExists('parameters');
    }
}

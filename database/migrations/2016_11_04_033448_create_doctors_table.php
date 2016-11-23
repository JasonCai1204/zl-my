<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     *create a new tiny integer column on the table
     * @param string $column
     */

    public function tinyInteger($column,  $autoIncrement = false)
    {
        return $this->addColumn('tinyInteger', $column, compact('autoIncrement'));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar',225)->nullable();
            $table->string('name',5);
            $table->string('grading',5);
            $table->text('introduction');
            $table->string('phone_number',11)->nullable();
            $table->string('password',225)->nullable();
            $table->integer('hospital_id');
            $table->boolean('is_certified')->default(0);
            $table->boolean('is_recommended')->default(0);
            $table->rememberToken()->nullable();
            $table->softDeletes()->nullable();
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
        Schema::dropIfExists('doctors');
    }
}

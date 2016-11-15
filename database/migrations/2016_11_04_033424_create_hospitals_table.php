<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
            $table->string('grading',9);
            $table->integer('city_id');
            $table->text('introduction');
            $table->tinyInteger('is_recommended');
            $table->softDeletes();
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
        Schema::dropIfExists('hospitals');
    }
}

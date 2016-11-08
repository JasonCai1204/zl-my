<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('patient_name',5);
            $table->string('phone_number',11);
            $table->integer('instance_id');
            $table->integer('hospital_id');
            $table->integer('doctor_id');
            $table->tinyInteger('gender');
            $table->date('birthday');
            $table->tinyInteger('smoking');
            $table->integer('weight');
            $table->string('wechat_id',20);
            $table->text('detail');
            $table->json('photos');
            $table->text('condition_report');
            $table->timestamp('send_to_the_doctor_at');
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
        Schema::dropIfExists('ordersoctor_c');
    }
}

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
            $table->integer('instance_id')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->boolean('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('weight',6)->nullable();
            $table->boolean('smoking')->nullable();
            $table->string('wechat_id',20)->nullable();
            $table->text('detail')->nullable();
            $table->json('photos')->nullable();
            $table->text('condition_report')->nullable();
            $table->timestamp('send_to_the_doctor_at')->nullable();
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
        Schema::dropIfExists('ordersoctor_c');
    }
}

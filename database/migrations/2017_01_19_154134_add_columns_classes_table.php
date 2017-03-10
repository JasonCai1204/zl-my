<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('banner_image')->nullable();
            $table->boolean('is_recommended')->nullsble();
            $table->integer('news_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_vi',100);
            $table->string('description_vi',255)->nullable();
            $table->string('name_en',100)->nullable();
            $table->string('description_en',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->unsignedBigInteger('space_id');
            $table->foreign('space_id')->references('id')->on('spaces');
            $table->boolean('display')->default(1);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_vi',100);
            $table->string('description_vi',255)->nullable();
            $table->text('content_vi');
            $table->string('name_en',100)->nullable();
            $table->string('description_en',255)->nullable();
            $table->text('content_en')->nullable();
            $table->string('slug',255)->nullable();
            $table->text('image')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width');
            $table->integer('height');
            $table->float('price');
            $table->integer('discount')->default(0)->nullable();
            $table->integer('sold')->default(0);
            $table->boolean('display')->default(1);
            $table->boolean('hot')->default(0);
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
}

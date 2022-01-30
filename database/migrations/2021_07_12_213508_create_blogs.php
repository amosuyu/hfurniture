<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',100);
            $table->text('image')->nullable();
            $table->string('description',255)->nullable();
            $table->text('content');
            $table->boolean('display')->default(1);
            $table->boolean('hot')->default(0);
            $table->text('slug')->nullable();
            $table->unsignedBigInteger('blog_type_id');
            $table->foreign('blog_type_id')->references('id')->on('blog_types');
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
        Schema::dropIfExists('blogs');
    }
}

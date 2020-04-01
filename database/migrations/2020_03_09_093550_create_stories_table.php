<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('story');
            $table->text('audio')->nullable();
            $table->text('img')->nullable();
            $table->bigInteger('tbl_category_id')->unsigned();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_stories');
    }
}

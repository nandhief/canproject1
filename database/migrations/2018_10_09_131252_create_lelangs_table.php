<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLelangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lelangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('embeded')->nullable();
            $table->string('path_image')->nullable()->default('lelang.jpg');
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->tinyInteger('notif')->default(false);
            $table->tinyInteger('highlight')->default(false);
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lelangs');
    }
}

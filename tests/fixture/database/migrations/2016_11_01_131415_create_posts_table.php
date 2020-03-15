<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->dateTime('publish_at');
            $table->timestamps();
        });
    }

    /**
     * Rollback the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}

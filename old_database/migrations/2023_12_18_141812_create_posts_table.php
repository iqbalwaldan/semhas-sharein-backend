<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // id of the user
            $table->unsignedBigInteger('user_fb_account_id'); // id of the user facebook account
            $table->string('title');
            $table->double('price');
            $table->string('caption');
            $table->string('hashtag');
            $table->datetime('post_time');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('group_id_destination');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_fb_account_id')
                ->references('id')
                ->on('facebook_accounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('media_id')
                ->references('id')
                ->on('media')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

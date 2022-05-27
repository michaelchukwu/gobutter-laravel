<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSuggestionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('chat');
            $table->integer('count');
            $table->timestamps();
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('closer')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_suggestions');
        Schema::dropColumns('tickets', 'closer');
    }
}

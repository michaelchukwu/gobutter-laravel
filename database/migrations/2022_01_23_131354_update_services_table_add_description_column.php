<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateServicesTableAddDescriptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('description')->after('title')->nullable();
        });
        Schema::create('knowledges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('article');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
        Schema::create('quicks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('article');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
        Schema::create('responders', function (Blueprint $table) {
            $table->id();
            $table->string('body');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('count')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('tag_responder', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->foreignId('responder_id');
            $table->timestamps();
        });
        Schema::create('tag_knowledge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->foreignId('knowledge_id');
            $table->timestamps();
        });
        Schema::create('tag_quick', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->foreignId('quick_id');
            $table->timestamps();
        });
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->foreignId('quick_id');
            $table->timestamps();
        });
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->foreignId('quick_id');
            $table->timestamps();
        });
        // faq authoer nullable
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::dropIfExists('knowledges');
        Schema::dropIfExists('quicks');
        Schema::dropIfExists('responders');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_responder');
        Schema::dropIfExists('tag_knowledge');
        Schema::dropIfExists('tag_quick');
        Schema::dropIfExists('emails');
        Schema::dropIfExists('logs');
    }
}

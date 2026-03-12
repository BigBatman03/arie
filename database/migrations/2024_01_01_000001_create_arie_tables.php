<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->string('type');
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('media_path')->nullable();
            $table->text('explanation')->nullable();
            $table->json('config')->nullable();
            $table->timestamps();
        });

        Schema::create('exercise_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->text('text');
            $table->boolean('is_correct')->default(false);
            $table->integer('ideal_score')->nullable();
            $table->timestamps();
        });

        Schema::create('module_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->integer('score');
            $table->integer('max_score');
            $table->timestamps();
        });

        Schema::create('sseit_questions', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('subscale');
            $table->boolean('is_reverse')->default(false);
            $table->timestamps();
        });

        Schema::create('sseit_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('perception')->default(0);
            $table->integer('use_emotions')->default(0);
            $table->integer('manage_own')->default(0);
            $table->integer('manage_others')->default(0);
            $table->integer('total_score')->default(0);
            $table->integer('max_total')->default(0);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('module');
            $table->string('type');
            $table->string('meta_data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('sseit_results');
        Schema::dropIfExists('sseit_questions');
        Schema::dropIfExists('module_results');
        Schema::dropIfExists('exercise_options');
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('modules');
    }
};

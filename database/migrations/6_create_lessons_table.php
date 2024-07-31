<?php

use App\Models\Lesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title', '255');
            $table->text('description');
            $table->string('grade', '255');
            $table->bigInteger('teacher_id');
            $table->smallInteger('has_uploads');
            $table->string('file_types', '500');
            $table->tinyInteger('state')->default(1);
            $table->timestamps();
        });

        Lesson::create([
            'title' => 'The Alphabet',
            'description' => 'Discover the English alphabet from A to Z with fun exercises, colorful illustrations, and engaging activities designed to build foundational literacy skills.',
            'grade' => '1',
            'teacher_id' => 1,
            'has_uploads' => 1,
            'file_types' => 'pdf',
            'state' => '1',
        ]);

        Lesson::create([
            'title' => 'Basic Vocabulary',
            'description' => 'Expand your vocabulary with simple words and sentences in English. Learn common nouns, verbs, and adjectives through interactive lessons and creative exercises.',
            'grade' => '1',
            'teacher_id' => 1,
            'has_uploads' => 1,
            'file_types' => 'pdf',
            'state' => '1',
        ]);

        Lesson::create([
            'title' => 'Colors and Shapes',
            'description' => 'Explore the world of colors and shapes through a series of engaging activities and games. Learn to identify and describe various colors, shapes, and patterns in English.',
            'grade' => '1',
            'teacher_id' => 1,
            'has_uploads' => 1,
            'file_types' => 'pdf',
            'state' => '1',
        ]);

        Lesson::create([
            'title' => 'Numbers and Counting',
            'description' => 'Master numbers and counting in English with interactive exercises, quizzes, and real-world examples. Develop strong numeracy skills and improve your ability to communicate numerical information.',
            'grade' => '1',
            'teacher_id' => 1,
            'has_uploads' => 1,
            'file_types' => 'pdf',
            'state' => '1',
        ]);

        Lesson::create([
            'title' => 'Daily Activities',
            'description' => 'Explore common daily activities and routines expressed in English sentences. From waking up in the morning to going to bed at night, learn how to describe your daily life in English with confidence.',
            'grade' => '1',
            'teacher_id' => 1,
            'has_uploads' => 1,
            'file_types' => 'pdf',
            'state' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};

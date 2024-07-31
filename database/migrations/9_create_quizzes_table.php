<?php

use App\Models\Quiz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('grade');
            $table->date('end_date');
            $table->integer('attempts');
            $table->tinyInteger('state')->default(1);
            $table->timestamps();
        });

        Quiz::create([
            'name' => 'English Vocabulary Quiz',
            'description' => 'Test your knowledge of English vocabulary with this quiz.',
            'grade' => 1,
            'end_date' => '2024-05-01',
            'attempts' => 3,
            'state' => 1,
        ]);

        Quiz::create([
            'name' => 'Science Quiz',
            'description' => 'Put your science knowledge to the test with this quiz covering various topics such as animals, plants, and the environment.',
            'grade' => 1,
            'end_date' => '2024-05-03',
            'attempts' => 3,
            'state' => 1,
        ]);

        Quiz::create([
            'name' => 'Math Quiz',
            'description' => 'Challenge yourself with this math quiz featuring questions on addition, subtraction, multiplication, and division.',
            'grade' => 1,
            'end_date' => '2024-05-06',
            'attempts' => 3,
            'state' => 1,
        ]);

        Quiz::create([
            'name' => 'Geography Quiz',
            'description' => 'Explore the world with this geography quiz covering continents, countries, capitals, and landmarks.',
            'grade' => 1,
            'end_date' => '2024-05-08',
            'attempts' => 3,
            'state' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};

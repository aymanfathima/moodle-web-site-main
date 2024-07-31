<?php

use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');
            $table->integer('answer');
            $table->bigInteger('quiz_id');
            $table->integer('state')->default(1);
            $table->timestamps();
        });

        $additionalQuestions = [
            [
                'question' => 'What is the opposite of "big"?',
                'option1' => 'Large',
                'option2' => 'Small',
                'option3' => 'Huge',
                'option4' => 'Giant',
                'answer' => 2,
            ],
            [
                'question' => 'Which planet is known as the Red Planet?',
                'option1' => 'Mars',
                'option2' => 'Venus',
                'option3' => 'Jupiter',
                'option4' => 'Mercury',
                'answer' => 1,
            ],
            [
                'question' => 'What is the capital of Japan?',
                'option1' => 'Tokyo',
                'option2' => 'Beijing',
                'option3' => 'Seoul',
                'option4' => 'Bangkok',
                'answer' => 1,
            ],
            [
                'question' => 'What is the largest mammal on Earth?',
                'option1' => 'Elephant',
                'option2' => 'Giraffe',
                'option3' => 'Blue Whale',
                'option4' => 'Gorilla',
                'answer' => 3,
            ],
            [
                'question' => 'What is the chemical symbol for water?',
                'option1' => 'H2O',
                'option2' => 'CO2',
                'option3' => 'O2',
                'option4' => 'NaCl',
                'answer' => 1,
            ],
            [
                'question' => 'What is the capital of Australia?',
                'option1' => 'Sydney',
                'option2' => 'Melbourne',
                'option3' => 'Canberra',
                'option4' => 'Brisbane',
                'answer' => 3,
            ],
            [
                'question' => 'What is the largest organ in the human body?',
                'option1' => 'Heart',
                'option2' => 'Liver',
                'option3' => 'Brain',
                'option4' => 'Skin',
                'answer' => 4,
            ],
            [
                'question' => 'Which is the longest river in the world?',
                'option1' => 'Amazon',
                'option2' => 'Nile',
                'option3' => 'Yangtze',
                'option4' => 'Mississippi',
                'answer' => 2,
            ],
            [
                'question' => 'What is the hardest natural substance on Earth?',
                'option1' => 'Diamond',
                'option2' => 'Steel',
                'option3' => 'Gold',
                'option4' => 'Iron',
                'answer' => 1,
            ],
            [
                'question' => 'Which country is famous for the Great Wall?',
                'option1' => 'China',
                'option2' => 'India',
                'option3' => 'Russia',
                'option4' => 'Egypt',
                'answer' => 1,
            ],
        ];

        foreach ($additionalQuestions as $questionData) {
            $questionData['quiz_id'] = 1;
            Question::create($questionData);
        }
        foreach ($additionalQuestions as $questionData) {
            $questionData['quiz_id'] = 2;
            Question::create($questionData);
        }
        foreach ($additionalQuestions as $questionData) {
            $questionData['quiz_id'] = 3;
            Question::create($questionData);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};

<?php

use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('email', '100')->unique()->nullable();
            $table->string('password');
            $table->string('first_name', '100');
            $table->string('last_name', '100');
            $table->string('phone', '20')->nullable();
            $table->string('address', '255')->nullable();
            $table->string('profile_picture', '255')->nullable();
            $table->tinyInteger('grade')->default('1');
            $table->rememberToken();
            $table->tinyInteger('state')->default('1');
            // 1 = active
            // 2 = blocked
            $table->timestamps();
        });


        Teacher::create([
            'email' => 'samudini@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Samudini',
            'last_name' => 'User',
            'phone' => '1234567890',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' =>  'user.png',
            'grade' => '1',
            'state' => '1',
        ]);
        Teacher::create([
            'email' => 'milinda@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Milinda',
            'last_name' => 'User',
            'phone' => '1234567890',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' =>  'user.png',
            'grade' => '1',
            'state' => '1',
        ]);
        Teacher::create([
            'email' => 'sehan@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Sehan',
            'last_name' => 'User',
            'phone' => '1234567890',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' =>  'user.png',
            'grade' => '1',
            'state' => '1',
        ]);
        Teacher::create([
            'email' => 'fathima@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Fathima',
            'last_name' => 'User',
            'phone' => '1234567890',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' =>  'user.png',
            'grade' => '1',
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
        Schema::dropIfExists('teachers');
    }
};

<?php

use App\Models\Student;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('email', '100')->unique()->nullable();
            $table->string('password');
            $table->string('first_name', '100');
            $table->string('last_name', '100');
            $table->string('parent_name', '100')->nullable();
            $table->tinyInteger('grade')->default('1');
            $table->string('phone', '20')->nullable();
            $table->string('address', '255')->nullable();
            $table->string('profile_picture', '255')->nullable();
            $table->tinyInteger('created_by')->default('-1');
            // -1 = self
            // +1 = admin
            $table->tinyInteger('created_by_role')->default('1');
            // 1 = user
            // 2 = admin
            // 3 = agent
            $table->rememberToken();
            $table->tinyInteger('state')->default('1');
            // 1 = active
            // 2 = blocked
            $table->timestamps();
        });

        Student::create([
            'email' => 'student1@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User1',
            'parent_name' => 'Parent 1',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student2@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User2',
            'parent_name' => 'Parent 2',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student3@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User3',
            'parent_name' => 'Parent 3',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student4@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User4',
            'parent_name' => 'Parent 4',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student5@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User5',
            'parent_name' => 'Parent 5',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student6@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User6',
            'parent_name' => 'Parent 6',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student7@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User7',
            'parent_name' => 'Parent 7',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student8@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User8',
            'parent_name' => 'Parent 8',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student9@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User9',
            'parent_name' => 'Parent 9',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student10@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User10',
            'parent_name' => 'Parent 10',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student11@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User11',
            'parent_name' => 'Parent 11',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student12@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User1',
            'parent_name' => 'Parent 12',
            'phone' => '12345678912',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student13@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User13',
            'parent_name' => 'Parent 13',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student14@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User14',
            'parent_name' => 'Parent 14',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
            'state' => '1',
        ]);
        Student::create([
            'email' => 'student15@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Student',
            'last_name' => 'User15',
            'parent_name' => 'Parent 15',
            'phone' => '1234567891',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
            'created_by' => '-1',
            'created_by_role' => '1',
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
        Schema::dropIfExists('students');
    }
};

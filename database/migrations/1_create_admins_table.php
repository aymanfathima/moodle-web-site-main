<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email', '100')->unique()->nullable();
            $table->string('password');
            $table->string('first_name', '100');
            $table->string('last_name', '100');
            $table->string('phone', '20')->nullable();
            $table->string('address', '255')->nullable();
            $table->string('profile_picture', '255')->nullable();
            $table->rememberToken();
            $table->tinyInteger('state')->default('1');
            // 1 = active
            // 2 = blocked
            $table->timestamps();
        });

        Admin::create([
            'email' => 'principle@gmail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Chinthani',
            'last_name' => 'Kulathunga',
            'phone' => '1234567890',
            'address' => 'Dhaka, Bangladesh',
            'profile_picture' => 'user.png',
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
        Schema::dropIfExists('admins');
    }
};
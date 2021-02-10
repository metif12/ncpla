<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('national_code')->unique();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->string('address')->nullable();

            $table->foreignIdFor(\App\Models\Shift::class)->nullable();

            $table->string('profile_photo')->default('img/profile.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

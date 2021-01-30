<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\User;

/**
 * Class CreateUsersTable
 *
 * @author JorgeCoronelG
 * @version 1.0
 * Created 27/07/2020
 */
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
            $table->string('email', 120)
                ->unique();
            $table->string('password');
            $table->string('complete_name', 150);
            $table->string('phone', 12);
            $table->text('photo');
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->string('api_token', User::API_TOKEN_LENGTH)
                ->nullable()
                ->unique()
                ->default(null);
            $table->boolean('verified')
                ->default(User::USER_NOT_VERIFIED);
            $table->string('verification_token', User::VERIFICATION_TOKEN_LENGTH)
                ->nullable();
            $table->timestamp('email_verified_at')
                ->nullable()
                ->default(null);
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

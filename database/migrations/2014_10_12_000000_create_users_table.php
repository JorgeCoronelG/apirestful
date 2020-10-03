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
            $table->string('email', 120)->unique();
            $table->string('password');
            $table->tinyInteger('role');
            $table->boolean('verified')->default(User::USUARIO_NO_VERIFICADO);
            $table->string('verification_token', '40')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
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

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserFactory
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Factories
 * Created 27/09/2020
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement([User::USER_MALE, User::USER_FEMALE]);
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'complete_name' => ($gender == User::USER_MALE) ? $this->faker->name('male') : $this->faker->name('female'),
            'phone' => $this->faker->numerify('###-###-####'),
            'photo' => User::USER_PHOTO_DEFAULT,
            'birthday' =>$this->faker->date('Y-m-d'),
            'gender' => $gender,
            'verified' => $verificado = $this->faker->randomElement([
                User::USER_VERIFIED,
                User::USER_NOT_VERIFIED,
                ]),
            'verification_token' => $verificado == User::USER_VERIFIED ? null : User::generarToken(User::TOKEN_LENGTH),
            'email_verified_at' => $verificado == User::USER_VERIFIED ? now() : null,
        ];
    }
}

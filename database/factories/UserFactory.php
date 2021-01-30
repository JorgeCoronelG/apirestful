<?php

namespace Database\Factories;

use App\Models\User;
use App\Util\Constants;
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
            'complete_name' => ($gender == User::USER_MALE)
                ? $this->faker->name(Constants::MALE_NAME_KEY)
                : $this->faker->name(Constants::FEMALE_NAME_KEY),
            'phone' => $this->faker->numerify(Constants::FORMAT_PHONE),
            'photo' => User::USER_PHOTO_DEFAULT,
            'birthday' =>$this->faker->date(Constants::FORMAT_DATE_YMD),
            'gender' => $gender,
            'verified' => $verificado = $this->faker->randomElement([
                User::USER_VERIFIED,
                User::USER_NOT_VERIFIED,
                ]),
            'verification_token' => ($verificado == User::USER_VERIFIED)
                ? null
                : User::generateVerificationToken(),
            'email_verified_at' => $verificado == User::USER_VERIFIED ? now() : null,
        ];
    }
}

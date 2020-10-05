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
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement([
                User::USUARIO_SUPER_ADMINISTRADOR,
                User::USUARIO_ADMINISTRADOR,
                User::USUARIO_RESPONSABLE_EQUIPO,
                User::USUARIO_JUGADOR,
                User::USUARIO_ARBITRO,
                ]),
            'verified' => $verificado = $this->faker->randomElement([
                User::USUARIO_VERIFICADO,
                User::USUARIO_NO_VERIFICADO,
                ]),
            'verification_token' => $verificado == User::USUARIO_VERIFICADO ? null : User::generarToken(User::TOKEN_LENGTH),
            'email_verified_at' => $verificado == User::USUARIO_VERIFICADO ? now() : null,
        ];
    }
}

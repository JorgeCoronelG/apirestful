<?php

namespace Database\Factories;

use App\Models\League;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class LeagueFactory
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Factories
 * Created 27/09/2020
 */
class LeagueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = League::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}

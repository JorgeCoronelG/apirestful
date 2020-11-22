<?php

namespace Database\Factories;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class NoticeFactory
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Factories
 * Created 21/11/2020
 */
class NoticeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'publish_at' => $this->faker->date(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'      => $this->faker->name,
            'email'     => $this->faker->safeEmail,
            'username'  => $this->faker->unique()->userName,
            'password'  => $this->faker->password,
            'telefone'  => $this->faker->phoneNumber,
        ];
    }
}

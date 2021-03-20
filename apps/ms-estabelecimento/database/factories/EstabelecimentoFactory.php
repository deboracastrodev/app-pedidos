<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstabelecimentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Estabelecimento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'razao_social'      => $this->faker->sentence,
            'nome_fantasia'      => $this->faker->sentence,
            'cnpj'      => $this->faker->randomNumber(14),
            'endereco'      => $this->faker->address,
            'email'     => $this->faker->safeEmail,
            'username'  => $this->faker->unique()->userName,
            'password'  => $this->faker->password,
            'telefone'  => $this->faker->phoneNumber,
        ];
    }
}

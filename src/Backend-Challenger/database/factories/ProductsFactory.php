<?php

namespace Database\Factories;

use App\Models\Despesa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "code" => Str::random(30),
            "product_name" => $this->faker->text(20),
            "quantity" => $this->faker->text(20),
            "brands" => $this->faker->text(40),
            "categories" => $this->faker->text(30),
            "status" => $this->faker->text(10),
        ];
    }
}

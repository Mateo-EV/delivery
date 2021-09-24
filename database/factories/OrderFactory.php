<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "code" => "23001541",
            "payment" => $this->faker->randomElement(["CONTADO", "CRÉDITO"]),
            "currency" => $this->faker->randomElement(["SOL", "DÓLAR"]),
            "channel" => $this->faker->randomElement(["DEPÓSITO", "EFECTIVO", "MASTERCARD", "VISA"]),
            "amount" => $this->faker->randomFloat(2, 100, 400),
            "document" => $this->faker->randomElement(["BOLETA", "FACTURA"]),
            "ndocument" => rand(100000, 999999),
            "arrival" => now()->addDay()
        ];
    }
}

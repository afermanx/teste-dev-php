<?php

namespace Database\Factories;

use App\Models\Supplier;
use Database\Factories\Traits\FakerDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
     use FakerDocument;
    protected $model = Supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


    $document = $this->generateRandomDocument();
    return [
            'name' => $this->faker->company,
            'user_id' => 1,
            'fantasy_name' => $this->faker->companySuffix,
            'document' => [
                'type' => $document['type'],
                'number' => $document['number'],
            ],
            'address' => [
                'street' => $this->faker->streetAddress,
                'number' => $this->faker->buildingNumber,
                'complement' => $this->faker->cityPrefix,
                'district' =>   $this->faker->country,
                'city' => $this->faker->city,
                'state' => $this->faker->state,
                'uf' =>     $this->faker->stateAbbr,
                'zipcode' => $this->faker->postcode,
            ],
            'phone' => [
                'ddd' => $this->faker->randomNumber(2),
                'number' => $this->faker->phoneNumber,
            ],
            'deleted_at' => $this->faker->optional(0.5)->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

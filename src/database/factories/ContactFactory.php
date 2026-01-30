<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{


    protected $model = Contact::class;


    public function definition()
    {

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->numerify('###########'),
            'address' => $this->faker->address(),
            'building' => $this->faker->city() . 'マンション' . $this->faker->buildingNumber(),
            'detail' => $this->faker->realText(120),
        ];
    }
}

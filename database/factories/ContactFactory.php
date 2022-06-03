<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Contact::class;
    public function definition()
    {
        return [
            'first_name'=> $this->faker->firstName,
            'last_name'=> $this->faker->lastName,
            'phone'=> $this->faker->phoneNumber,
            'email'=> $this->faker->email,
            'address'=> $this->faker->address,
            'company_id'=> Company::pluck('id')->random(),
            'user_id'    => Company::find(Company::pluck('id')->random())->user_id
        ];
    }
}

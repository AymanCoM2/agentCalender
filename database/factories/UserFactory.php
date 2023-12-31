<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'userCode' => fake()->postcode(),
            'password' =>  Hash::make('123'),
            'pass_as_string' =>  '123',
            'remember_token' => Str::random(10),
        ];
    }
}

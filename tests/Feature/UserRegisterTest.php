<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use WithFaker;

    public function testRegisterWithNoParameterShouldBeUnprocessableEntity()
    {
        $response = $this->json('POST', '/api/register', []);

        $response
            ->assertStatus(422);
    }

    public function testRegisterWithEmailOnlyShouldBeUnprocessableEntity()
    {
        $response = $this->json('POST', '/api/register', [
            'email' => $this->faker->email(),
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterPasswordNoVerifyShouldBeUnprocessableEntity()
    {
        $response = $this->json('POST', '/api/register', [
            'email'     => $this->faker->email(),
            'password'  => 'p@s5W0rD1234',
        ]);

        $response
            ->assertStatus(422);
    }

    public function testRegisterWithPasswordNotVerifiedShouldBeUnprocessableEntity()
    {
        $response = $this->json('POST', '/api/register', [
            'username'    => $this->faker->userName(),
            'email'       => $this->faker->email(),
            'password'    => 'p@s5W0rD1234',
            'v_password'  => 'p@s5W0rD12341',
        ]);
        $response
            ->assertStatus(422);
    }

    public function testRegisterWithoutFullnameShouldBeUnprocessableEntity()
    {
        $response = $this->json('POST', '/api/register', [
            'username'    => $this->faker->userName(),
            'email'       => $this->faker->email(),
            'password'    => 'p@s5W0rD1234',
            'v_password'  => 'p@s5W0rD1234',
        ]);
        $response
            ->assertStatus(422);
    }

    public function testRegisterWithCorrectParametersShouldRegisterSuccessfully()
    {
        $response = $this->json('POST', '/api/register', [
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => 'p@s5W0rD1234',
            'v_password' => 'p@s5W0rD1234',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
        ]);

        $response
            ->assertStatus(200);
    }

    public function testRegisterWithCorrectParametersAndPermissionShouldRegisterSuccessfully()
    {
        $response = $this->json('POST', '/api/register', [
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => 'p@s5W0rD1234',
            'v_password' => 'p@s5W0rD1234',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'permissions' => [
                'view.user' => true,
                'update.user' => true,
            ]
        ]);
        $response
            ->assertStatus(200);
    }
}

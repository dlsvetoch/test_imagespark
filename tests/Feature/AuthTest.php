<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testRegister()
    {
        $this->json('POST', '/api/v1/register'
        )->assertStatus(422);

        /** Register without confirmation password */
        $this->json('POST', '/api/v1/register',
            [
                'email'                 => 'example@mail.com',
                'name'                  => 'Test Name',
                'password'              => 'password',
                'password_confirmation' => ''

            ]
        )->assertStatus(422);

        /** Register with non-unique email */
        $this->json('POST', '/api/v1/register',
            [
                'email'                 => 'test@test.com',
                'name'                  => 'Test Name',
                'password'              => 'password',
                'password_confirmation' => 'password'

            ]
        )->assertStatus(422);

        /** Register with incorrect email */
        $this->json('POST', '/api/v1/register',
            [
                'email'                 => 'test',
                'name'                  => 'Test Name',
                'password'              => 'password',
                'password_confirmation' => 'password'

            ]
        )->assertStatus(422);

        /** Register with incorrect name */
        $this->json('POST', '/api/v1/register',
            [
                'email'                 => 'test',
                'name'                  => 't',
                'password'              => 'password',
                'password_confirmation' => 'password'

            ]
        )->assertStatus(422);

        /** Register without name*/
        $this->json('POST', '/api/v1/register',
            [
                'email'                 => 'example@mail.com',
                'name'                  => '',
                'password'              => 'password',
                'password_confirmation' => 'password'

            ]
        )->assertStatus(422);

        $this->json('POST', '/api/v1/register',
            [
                'email'                 => 'example@mail.com',
                'name'                  => 'Test Name',
                'password'              => 'password',
                'password_confirmation' => 'password'

            ]
        )->assertStatus(201);
    }

    public function testLogin()
    {
        /** Login with incorrect credentials */
        $this->json('POST', '/api/v1/login',
            [
                'email'                 => 'example@test.com',
                'password'              => 'password',

            ]
        )->assertStatus(422);

        /** Login with correct credentials */
        $this->json('POST', '/api/v1/login',
            [
                'email'                 => 'test@test.com',
                'password'              => 'password',

            ]
        )->assertStatus(200);
    }
}

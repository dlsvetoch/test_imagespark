<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthorTest extends FeatureTestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function testGetAuthors(): void
    {
        $this->get($this->authorsURL)
            ->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testGetAuthorsById():void
    {
        /** Get nonexistent author */
        $this->get($this->nonexistentAuthorURL)
            ->assertRedirect($this->notFoundURL);

        /** Get existing author */
        $this->get($this->existingAuthorURL)
            ->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testCreateAuthor():void
    {
        /** Create author with empty name */
        $this->json('POST', $this->authorsURL,
            [
                'name' => '',
            ]
        )->assertStatus(422);

        /** Create author with int */
        $this->json('POST', $this->authorsURL,
            [
                'name' => 12345,
            ]
        )->assertStatus(422);

        /** Create author without name */
        $this->json('POST', $this->authorsURL
        )->assertStatus(422);

        /** Create author with one character */
        $this->json('POST', $this->authorsURL,
            [
                'name' => 't',
            ]
        )->assertStatus(422);

        /** Create author with the number of characters exceeding the condition */
        $this->json('POST', $this->authorsURL,
            [
                'name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ]
        )->assertStatus(422);

        /** Create author in compliance with all conditions */
        $this->json('POST', $this->authorsURL,
            [
                'name' => 'Test Author',
            ]
        )->assertStatus(201);
    }

    public function testUpdateAuthor():void
    {
        /** Update author with nonexistent author id */
        $this->json('PUT', $this->nonexistentAuthorURL
        )->assertRedirect($this->notFoundURL);

        /** Update author with empty name */
        $this->json('PUT', $this->existingAuthorURL,
            [
                'name' => '',
            ]
        )->assertStatus(422);

        /** Update author with empty one character */
        $this->json('PUT', $this->existingAuthorURL,
            [
                'name' => 't',
            ]
        )->assertStatus(422);

        /** Update author with empty int value name */
        $this->json('PUT', $this->existingAuthorURL,
            [
                'name' => 123,
            ]
        )->assertStatus(422);

        /** Update author in compliance with all conditions */
        $this->json('PUT', $this->existingAuthorURL,
            [
                'name' => 'Test Author',
            ]
        )->assertStatus(200);
    }

    public function testDeleteAuthor():void
    {
        $this->json('DELETE', $this->nonexistentAuthorURL
        )->assertRedirect($this->notFoundURL);

        $this->json('DELETE', $this->existingAuthorURL
        )->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookTest extends FeatureTestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function testGetBooks(): void
    {
        /** Get all books */
        $this->get($this->booksURL)
            ->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testGetBooksById():void
    {
        /** Get nonexistent book */
        $this->get($this->nonexistentBookURL)
            ->assertRedirect($this->notFoundURL);

        /** Get existent book */
        $this->get($this->existingBookURL)
            ->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testCreateBook():void
    {
        /** Create book without author_id */
        $this->json('POST', $this->booksURL,
            [
                'title' => 'test',
            ]
        )->assertStatus(422);

        /** Create book without title */
        $this->json('POST', $this->booksURL,
            [
                'author_id' => 1,
            ]
        )->assertStatus(422);

        /** Create book with one character title */
        $this->json('POST', $this->booksURL,
            [
                'title' => 't',
                'author_id' => 1,
            ]
        )->assertStatus(422);

        /** Create book with string author_id */
        $this->json('POST', $this->booksURL,
            [
                'title' => 'test',
                'author_id' => 'test',
            ]
        )->assertStatus(422);

        /** create book with nonexistent author */
        $this->json('POST', $this->booksURL,
            [
                'title' => 'test',
                'author_id' => $this->nonexistentAuthorId,
            ]
        )->assertStatus(422);

        /** Create book in compliance with all conditions */
        $this->json('POST', $this->booksURL,
            [
                'title' => 'test',
                'author_id' => $this->existingAuthorId
            ]
        )->assertStatus(200);
    }

    public function testUpdateBook():void
    {
        /** Update nonexistent book */
        $this->json('PUT', $this->nonexistentBookURL,
            [
                'title' => 'test',
            ]
        )->assertRedirect($this->notFoundURL);

        /** Update book with one character title */
        $this->json('PUT', $this->existingBookURL,
            [
                'title' => 't',
            ]
        )->assertStatus(422);

        /** Update book with string value author_id */
        $this->json('PUT', $this->existingBookURL,
            [
                'author_id' => 'test',
            ]
        )->assertStatus(422);

        $this->json('PUT', $this->existingBookURL,
            [
                'author_id' => $this->nonexistentAuthorId,
            ]
        )->assertStatus(422);

        $this->json('PUT', $this->existingBookURL,
            [
                'title'     => 'Test Title',
                'author_id' => $this->existingAuthorId,
            ]
        )->assertStatus(200);
    }

    public function testDeleteBook():void
    {
        $this->json('DELETE', $this->nonexistentBookURL
        )->assertRedirect($this->notFoundURL);

        $this->json('DELETE', $this->existingBookURL
        )->assertStatus(200);
    }
}

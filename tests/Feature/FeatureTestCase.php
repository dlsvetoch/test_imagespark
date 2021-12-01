<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\CreatesApplication;
use Tests\TestCase;

abstract class FeatureTestCase extends TestCase
{
    use CreatesApplication;

    protected $user;

    protected $booksURL;
    protected $existingBookId;
    protected $existingBookURL;
    protected $nonexistentBookId;
    protected $nonexistentBookURL;

    protected $authorsURL;
    protected $existingAuthorId;
    protected $existingAuthorURL;
    protected $nonexistentAuthorId;
    protected $nonexistentAuthorURL;

    protected $notFoundURL;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::find(1);

        $lastBook = Book::orderBy('id', 'desc')->first();
        $lastAuthor = Author::orderBy('id', 'desc')->first();

        $this->booksURL = '/api/v1/books/';
        $this->existingBookId = $lastBook->id;
        $this->existingBookURL = $this->booksURL . $this->existingBookId;
        $this->nonexistentBookId = $lastBook->id + 1;
        $this->nonexistentBookURL = $this->booksURL . $this->nonexistentBookId;

        $this->authorsURL = '/api/v1/authors/';
        $this->existingAuthorId = $lastAuthor->id;
        $this->existingAuthorURL = $this->authorsURL . $this->existingAuthorId;
        $this->nonexistentAuthorId = $this->existingAuthorId + 1;
        $this->nonexistentAuthorURL = $this->authorsURL . $this->nonexistentAuthorId;

        $this->notFoundURL = 'api/v1/404';

        Sanctum::actingAs($this->user);
    }
}

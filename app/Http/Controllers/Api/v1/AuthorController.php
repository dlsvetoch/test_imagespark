<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Traits\MathTrait;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class AuthorController extends ApiController
{
    use MathTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $model = new Author();
        $result = $this->getItemsByRequest($request, $model);

        return $this->sendResponse($result, 'Ok', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Author $author
     * @return JsonResponse
     */
    public function show(Author $author)
    {
        return $this->sendResponse(['authors' => $author], 'Ok', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Author $author
     * @return JsonResponse
     */
    public function showAuthorBooks(Author $author): JsonResponse
    {
        $books = Book::where('author_id', $author->id)->get();

        return $this->sendResponse(['total' => $books->count(), 'books' => $books], 'Ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAuthorRequest  $request
     * @return JsonResponse
     */
    public function store(CreateAuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->all());

        return $this->sendResponse(['author' => $author], 'Created', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAuthorRequest  $request
     * @param  Author               $author
     * @return JsonResponse
     */
    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        if ($request->exists('rating')) {
            $author = $this->setRating($request, $author);

            return $this->sendResponse(['books' => $author], 'Updated', 200);
        }

        $author->update($request->all());

        return $this->sendResponse(['authors' => $author], 'Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Author $author
     * @return JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        $author->delete();

        return $this->sendResponse([], 'Deleted', 200);
    }
}

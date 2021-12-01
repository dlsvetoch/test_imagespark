<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class BookController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $book = new Book();

        if ($request->exists('search')) {
            $result = $book->fulltextSearchByBookOrAuthor($request->get('search'), $request->all());
        } else {
            $result = $this->getItemsByRequest($request, $book);
        }

        return $this->sendResponse($result, 'Ok', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Book $book
     * @return JsonResponse
     */
    public function show(Book $book)
    {
        return $this->sendResponse(['books' => $book], 'Ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBookRequest $request
     * @return JsonResponse
     */
    public function store(CreateBookRequest $request): JsonResponse
    {
        $book = Book::create($request->all());

        return $this->sendResponse(['books' => $book], 'Ok', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAuthorRequest $request
     * @param  Book                $book
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        if ($request->exists('rating')) {
            $book = $this->setRating($request, $book);

            return $this->sendResponse(['books' => $book], 'Updated', 200);
        }

        $book->update($request->all());

        return $this->sendResponse(['books' => $book], 'Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return $this->sendResponse([], 'Deleted', 200);
    }
}

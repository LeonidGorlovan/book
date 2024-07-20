<?php

namespace App\Services;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookService
{
    public function responseAll(): JsonResponse
    {
        $books = Book::query()->paginate();

        if ($books->isNotEmpty()) {
            $responseData = [
                'success' => true,
                'data' => BookResource::collection($books->items()),
                'current_page' => $books->currentPage(),
                'first_page_url' => $books->url($books->firstItem()),
                'from' => $books->firstItem(),
                'last_page' => $books->lastPage(),
                'last_page_url' => $books->url($books->lastPage()),
                'next_page_url' => $books->nextPageUrl(),
                'path' => $books->path(),
                'per_page' => $books->perPage(),
                'prev_page_url' => $books->url($books->previousPageUrl()),
                'to' => $books->lastItem(),
                'total' => $books->total(),
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => 'Books not found',
            ];
        }

        return response()->json($responseData);
    }

    public function responseOne(int $id): JsonResponse
    {
        $book = Book::query()->find($id);

        if ($book) {
            $responseData = [
                'success' => true,
                'data' => BookResource::make($book)
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => 'Book not found',
            ];
        }

        return response()->json($responseData);
    }

    public function responseStore(array $data): JsonResponse
    {
        $book = Book::query()->create($data);


        $responseData = [
            'success' => true,
            'data' => BookResource::make($book)
        ];

        return response()->json($responseData);
    }

    public function responseUpdate(int $id, array $data): JsonResponse
    {
        $book = Book::query()->find($id);

        if ($book) {
            $book->update($data);

            $responseData = [
                'success' => true,
                'data' => BookResource::make($book)
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => 'Book not found',
            ];
        }

        return response()->json($responseData);
    }

    public function responseDestroy(int $id): JsonResponse
    {
        $book = Book::query()->find($id);

        if ($book) {
            $book->delete();

            $responseData = [
                'success' => true,
                'message' => 'Book "' . $book->title . '" is deleted',
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => 'Book not found',
            ];
        }

        return response()->json($responseData);
    }
}

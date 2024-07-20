<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(): JsonResponse
    {
        return $this->bookService->responseAll();
    }

    public function show(int $id): JsonResponse
    {
        return $this->bookService->responseOne($id);
    }

    public function store(BookStoreRequest $request): JsonResponse
    {
        return $this->bookService->responseStore($request->validated());
    }

    public function update(BookStoreRequest $request, int $id): JsonResponse
    {
        return $this->bookService->responseUpdate($id, $request->validated());
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->bookService->responseDestroy($id);
    }
}

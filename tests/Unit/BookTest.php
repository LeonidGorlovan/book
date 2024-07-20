<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllBooks(): void
    {
        Book::factory()->count(5)->create();

        $response = $this->get(route('book.index'));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'publisher',
                        'author',
                        'genre',
                        'publication',
                        'amount_words_book',
                        'price',
                        'created_at',
                        'updated_at'
                    ]
                ],
                'current_page',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }

    public function testGetOneBook(): void
    {
        $book = Book::query()->create([
            'title' => 'Book 1',
            'publisher' => 'Publisher 1',
            'author' => 'Author 1',
            'genre' => 'Genre 1',
            'publication' => '2020-03-24',
            'amount_words_book' => 100,
            'price' => 234.55,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->get(route('book.show', ['book' => $book->id]));
        $response->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'data' => [
                    'id' => $book->id,
                    'title' => $book->title,
                    'publisher' => $book->publisher,
                    'author' => $book->author,
                    'genre' => $book->genre,
                    'publication' => $book->publication,
                    'amount_words_book' => $book->amount_words_book,
                    'price' => $book->price,
                    'created_at' => $book->created_at->toDateTimeString(),
                    'updated_at' => $book->updated_at->toDateTimeString()
                ]
            ]);
    }

    public function testStoreBook(): void
    {
        $payload = [
            'title' => 'Book 1',
            'publisher' => 'Publisher 1',
            'author' => 'Author 1',
            'genre' => 'Genre 1',
            'publication' => '2020-03-24',
            'amount_words_book' => 100,
            'price' => 234.55,
            'created_at' => now(),
            'updated_at' => now()
        ];

        $response = $this->post(route('book.store'), $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'title',
                    'publisher',
                    'author',
                    'genre',
                    'publication',
                    'amount_words_book',
                    'price',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('books', $payload);
    }

    public function testUpdateBook(): void
    {
        $book = Book::query()->create([
            'title' => 'Book 1',
            'publisher' => 'Publisher 1',
            'author' => 'Author 1',
            'genre' => 'Genre 1',
            'publication' => '2020-03-24',
            'amount_words_book' => 100,
            'price' => 234.55,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $payload = [
            'title' => 'Book 2',
            'publisher' => 'Publisher 2',
            'author' => 'Author 2',
            'genre' => 'Genre 2',
            'publication' => '2020-05-14',
            'amount_words_book' => 200,
            'price' => 522.25,
            'created_at' => now(),
            'updated_at' => now()
        ];

        $response = $this->put(route('book.update', ['book' => $book->id]), $payload);
        $response->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'data' => [
                    'id' => $book->id,
                    'title' => $payload['title'],
                    'publisher' => $payload['publisher'],
                    'author' => $payload['author'],
                    'genre' => $payload['genre'],
                    'publication' => $payload['publication'],
                    'amount_words_book' => $payload['amount_words_book'],
                    'price' => $payload['price'],
                    'created_at' => $book->created_at->toDateTimeString(),
                    'updated_at' => $book->updated_at->toDateTimeString()
                ]
            ]);
    }

    public function testDestroyBook(): void
    {
        $payload = [
            'title' => 'Book 1',
            'publisher' => 'Publisher 1',
            'author' => 'Author 1',
            'genre' => 'Genre 1',
            'publication' => '2020-03-24',
            'amount_words_book' => 100,
            'price' => 234.55,
            'created_at' => now(),
            'updated_at' => now()
        ];

        $book = Book::query()->create($payload);

        $response = $this->delete(route('book.destroy', ['book' => $book->id]));
        $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message'
        ]);

        $this->assertDatabaseMissing('books', $payload);
    }
}

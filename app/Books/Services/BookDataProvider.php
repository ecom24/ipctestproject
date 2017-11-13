<?php

namespace App\Books\Services;

use Illuminate\Support\Collection;
use App\Services\Contracts\BookFactory as BookFactoryInterface;

class BookDataProvider
{
    /**
     * @var BookFactoryInterface
     */
    protected $bookFactory;

    /**
     * @var Collection
     */
    protected $books;

    /**
     * @var array
     */
    protected $rawBookData =
        [
            [
                'isbn' => '978-1491918661',
                'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
                'author' => 'Robin Nixon',
                'category' => 'PHP,Javascript',
                'price' => '9.99 GBP'
            ],
            [
                'isbn' => '978-0596804848',
                'title' => 'Ubuntu: Up and Running: A Power User\'s Desktop Guide',
                'author' => 'Robin Nixon',
                'category' => 'Linux',
                'price' => '12.99 GBP'
            ],
            [
                'isbn' => '978-1118999875',
                'title' => 'Linux Bible',
                'author' => 'Christopher Negus',
                'category' => 'Linux',
                'price' => '19.99 GBP'
            ],
            [
                'isbn' => '978-0596517748',
                'title' => 'JavaScript: The Good Part',
                'author' => 'Douglas Crockford',
                'category' => 'Javascript',
                'price' => '8.99 GBP'
            ]
        ];

    /**
     * BookDataProvider constructor
     * @param BookFactoryInterface $bookFactory
     */
    public function __construct(BookFactoryInterface $bookFactory)
    {
        $this->bookFactory = $bookFactory;

        $rawBooks = new Collection($this->rawBookData);

        $this->books = $rawBooks->map(function($book) {
            return new Collection($book);
        });
    }

    /**
     * @return Collection
     */
    public function getBooks()
    {
        $books = new Collection();

        $this->books->map(function($book) use ($books) {
            $newBook = $this->bookFactory->make();

            $newBook->setIsbn($book->get('isbn'));
            $newBook->setTitle($book->get('title'));
            $newBook->setAuthor($book->get('author'));

            $categories = explode(',', $book->get('category'));
            $newBook->setCategories(new Collection($categories));

            $newBook->setPrice($book->get('price'));

            $books->push($newBook);
        });

        return $books;
    }
}

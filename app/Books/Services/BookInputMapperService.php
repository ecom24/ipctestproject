<?php

namespace App\Books\Services;

use App\Book\Entities\Contracts\Book as BookInterface;
use App\Books\Services\Contracts\BookInputMapperService as BookInputMapperServiceInterface;
use Illuminate\Support\Collection;

class BookInputMapperService implements BookInputMapperServiceInterface
{
    /**
     * @param BookInterface $book
     * @param array $bookData
     *
     * @return BookInterface
     */
    public function map(BookInterface $book, array $bookData)
    {
        $book->setIsbn($bookData['isbn']);
        $book->setTitle($bookData['title']);
        $book->setAuthor($bookData['author']);

        $categories = explode(',', $bookData['category']);
        $book->setCategories(new Collection($categories));

        $book->setPrice($bookData['price']);

        return $book;
    }
}

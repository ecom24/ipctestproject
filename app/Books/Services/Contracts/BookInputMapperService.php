<?php

namespace App\Books\Services\Contracts;

use App\Book\Entities\Contracts\Book as BookInterface;

interface BookInputMapperService
{
    /**
     * @param BookInterface $book
     * @param array $bookData
     *
     * @return BookInterface
     */
    public function map(BookInterface $book, array $bookData);
}

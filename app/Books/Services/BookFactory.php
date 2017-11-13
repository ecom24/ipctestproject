<?php

namespace App\Books\Services;

use App\Books\Entities\Book;
use App\Services\Contracts\BookFactory as BookFactoryInterface;
use App\Book\Entities\Contracts\Book as BookInterface;

class BookFactory implements BookFactoryInterface
{
    /**
     * @return BookInterface
     */
    public function make()
    {
        return new Book();
    }
}

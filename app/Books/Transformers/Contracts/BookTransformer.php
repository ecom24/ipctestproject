<?php

namespace App\Books\Transformers\Contracts;

use App\Book\Entities\Contracts\Book as BookInterface;
use Illuminate\Support\Collection;

interface BookTransformer
{
    /**
     * @param BookInterface $book
     *
     * @return array
     */
    public function transform(BookInterface $book);

    /**
     * @param Collection $books
     *
     * @return array
     */
    public function transformAll(Collection $books);
}

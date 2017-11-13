<?php

namespace App\Books\Transformers;

use League\Fractal\TransformerAbstract;
use App\Books\Transformers\Contracts\BookTransformer as BookTransformerInterface;
use App\Book\Entities\Contracts\Book as BookInterface;
use Illuminate\Support\Collection;

class BookTransformer extends TransformerAbstract implements BookTransformerInterface
{
    /**
     * @param BookInterface $book
     *
     * @return array
     */
    public function transform(BookInterface $book)
    {
        $categories = $book->getCategories()->implode(',');

        return [
            'isbn' => $book->getIsbn(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'category' => $categories,
            'price' => $book->getPrice()
        ];
    }

    /**
     * @param Collection|BookInterface[] $books
     *
     * @return array
     */
    public function transformAll(Collection $books)
    {
        $bookArray = $books->map(function($book) {
            return $this->transform($book);
        })->values()->toArray();

        return $bookArray;
    }
}

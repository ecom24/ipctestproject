<?php

namespace App\Books\Repositories;

use Illuminate\Support\Collection;
use App\Books\Repositories\Contracts\BookRepository as BookRepositoryInterface;
use App\Book\Entities\Contracts\Book as BookInterface;
use App\Books\Services\BookDataProvider;

class BookDemoRepository implements BookRepositoryInterface
{
    /**
     * @var Collection|BookInterface[]
     */
    protected $books;

    /**
     * BookDemoRepository constructor
     * @param BookDataProvider $dataService
     */
    public function __construct(BookDataProvider $dataService)
    {
        $this->books = $dataService->getBooks();
    }

    /**
     * @param Collection|BookInterface[] $books
     * @param string $author
     *
     * @return Collection
     */
    protected function filterByAuthor(Collection $books, string $author)
    {
        $filteredBooks = $books->filter(function(BookInterface $book) use ($author) {
            return strtolower($book->getAuthor()) == strtolower($author);
        });

        return $filteredBooks;
    }

    /**
     * @param Collection|BookInterface[] $books
     * @param string $category
     *
     * @return Collection
     */
    protected function filterByCategory(Collection $books, string $category)
    {
        $filteredBooks = $books->filter(function(BookInterface $book) use ($category) {
            $bookCategories = $book->getCategories()->map(function($category) {
                return strtolower($category);
            });

            return $bookCategories->contains(strtolower($category));
        });

        return $filteredBooks;
    }

    /**
     * @param array|null $filter
     *
     * @return Collection
     */
    public function findBy($filter)
    {
        $author = (! empty($filter['author'])) ? $filter['author'] : null;
        $category = (! empty($filter['category'])) ? $filter['category'] : null;

        $books = $this->books;

        if ($author) {
            $books = $this->filterByAuthor($books, $author);
        }

        if ($category) {
            $books = $this->filterByCategory($books, $category);
        }

        return $books;
    }

    /**
     * @return Collection
     */
    public function getCategories()
    {
        $categories = new Collection();

        $categories = $this->books->map(function($book) use ($categories) {
            return $categories->push($book->getCategories());
        });

        return $categories->flatten()->unique();
    }
}

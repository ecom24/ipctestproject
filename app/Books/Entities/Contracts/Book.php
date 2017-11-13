<?php

namespace App\Book\Entities\Contracts;

use App\Products\Contracts\Product as ProductInterface;
use Illuminate\Support\Collection;

interface Book extends ProductInterface
{
    /**
     * @return string
     */
    public function getIsbn();

    /**
     * @param string $isbn
     *
     * @return $this
     */
    public function setIsbn($isbn);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getAuthor();

    /**
     * @param string $author
     *
     * @return $this
     */
    public function setAuthor($author);

    /**
     * @return Collection
     */
    public function getCategories();

    /**
     * @param string $category
     *
     * @return $this
     */
    public function addCategory(string $category);

    /**
     * @param Collection $categories
     *
     * @return $this
     */
    public function setCategories(Collection $categories);
}

<?php

namespace App\Books\Repositories\Contracts;

use Illuminate\Support\Collection;

interface BookRepository
{
    /**
     * @param array $filter
     *
     * @return Collection
     */
    public function findBy($filter);

    /**
     * @return mixed
     *
     * @return Collection
     */
    public function getCategories();
}

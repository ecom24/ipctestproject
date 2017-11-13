<?php

namespace App\Services\Contracts;

use App\Book\Entities\Contracts\Book as BookInterface;

interface BookFactory
{
    /**
     * @return BookInterface
     */
    public function make();
}

<?php

namespace App\Services\Contracts;

interface EntityManager
{
    /**
     * @param $entity
     *
     * @return mixed
     */
    public function persist($entity);
}

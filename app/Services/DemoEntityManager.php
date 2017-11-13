<?php

namespace App\Services;

use App\Services\Contracts\EntityManager as EntityManagerInterface;

class DemoEntityManager implements EntityManagerInterface
{
    /**
     * @param $entity
     *
     * @return mixed
     */
    public function persist($entity)
    {
        return $entity;
    }
}

<?php

namespace App\Products\Contracts;

interface Product {
    /**
     * @return string
     */
    public function getPrice();

    /**
     * @param string $price
     *
     * @return $this
     */
    public function setPrice($price);
}

<?php

namespace App\Repositories;

use App\Product;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }
}

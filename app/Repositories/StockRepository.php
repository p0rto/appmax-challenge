<?php

namespace App\Repositories;

use App\Stock;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class StockRepository.
 */
class StockRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Stock::class;
    }
}

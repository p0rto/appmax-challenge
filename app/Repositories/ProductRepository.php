<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Database\Eloquent\Collection;
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

    public function getProductsThatAreNotOnStock() : Collection
    {
        return $this->model->select('products.*')
            ->whereNotIn('products.id', function ($query) {
                $query->select('stocks.product_id')
                    ->from('stocks')
                    ->whereNull('stocks.deleted_at');
            })
            ->get();
    }
}

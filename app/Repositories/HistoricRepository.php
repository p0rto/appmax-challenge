<?php

namespace App\Repositories;

use App\Historic;
use Illuminate\Database\Eloquent\Collection;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class HistoricRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Historic::class;
    }

    public function getByOperation(int $operation) : Collection
    {
        return $this->model->select('*')
            ->where('operation', '=', $operation)
            ->orderBy('created_at', 'ASC')
            ->get();
    }
}

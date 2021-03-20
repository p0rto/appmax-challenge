<?php

namespace App\Http\Controllers;

use App\Historic;
use App\Repositories\HistoricRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportsController extends Controller
{
    private $historicRepository;
    private $stockRepository;
    private $productRepository;

    public function __construct(
        HistoricRepository $historicRepository,
        StockRepository $stockRepository,
        ProductRepository $productRepository
    )
    {
        $this->historicRepository = $historicRepository;
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
    }

    public function index() : View
    {
        return view('reports.index');
    }

    public function addedProducts() : View
    {
        $historic = $this->historicRepository->getByOperation(Historic::ADD_STOCK_QUANTITY_OPERATION);

        return view('reports.stock-historic')->with('historic', $historic);
    }

    public function removedProducts() : View
    {
        $historic = $this->historicRepository->getByOperation(Historic::REMOVE_STOCK_QUANTITY_OPERATION);

        return view('reports.stock-historic')->with('historic', $historic);
    }
}

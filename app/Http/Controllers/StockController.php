<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\View\View;

class StockController extends Controller
{
    private $stockRepository;

    private $productRepository;

    public function __construct(
        StockRepository $stockRepository,
        ProductRepository $productRepository
    )
    {
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
    }

    public function index() : View
    {
        $stocks = $this->stockRepository->all();

        return view('stocks.index')->with('stocks', $stocks);
    }

    public function create() : View
    {
        $productsThatAreNotOnStock = $this->productRepository->getProductsThatAreNotOnStock();

        return view('stocks.create')->with('products', $productsThatAreNotOnStock);
    }

    public function store(StoreStockRequest $request)
    {
        try {
            $this->stockRepository->create($request->validated());

            return redirect()->route('stocks.index')->with('status', 'New stock registered.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }

    public function show(int $id)
    {
        return redirect()->route('stocks.edit', ['stock' => $id]);
    }

    public function edit(int $id) : View
    {
        $stock = $this->stockRepository->getById($id);
        $products = $this->productRepository->getProductsThatAreNotOnStock();

        return view('stocks.edit')->with('stock', $stock)->with('products', $products);
    }

    public function update(UpdateStockRequest $request, int $id)
    {
        try {
            $this->stockRepository->updateById($id, $request->validated());

            return redirect()->route('stocks.index')->with('status', 'Stock updated.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->stockRepository->deleteById($id);

            return redirect()->route('stocks.index')->with('status', 'Stock deleted.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }
}

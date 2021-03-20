<?php

namespace App\Http\Controllers;

use App\Historic;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Repositories\HistoricRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\View\View;

class StockController extends Controller
{
    private $stockRepository;

    private $productRepository;

    private $historicRepository;

    public function __construct(
        StockRepository $stockRepository,
        ProductRepository $productRepository,
        HistoricRepository $historicRepository
    )
    {
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
        $this->historicRepository = $historicRepository;
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
            $stock = $this->stockRepository->create($request->validated());

            $historicData = [
                'stock_id' => $stock->id,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => $request['quantity']
            ];

            $this->historicRepository->create($historicData);

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
            $stock = $this->stockRepository->getById($id);

            $this->stockRepository->updateById($id, $request->validated());

            if ($stock->quantity < $request['quantity']) {
                $increasedQuantity = $request['quantity'] - $stock->quantity;

                $historicData = [
                    'stock_id' => $stock->id,
                    'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                    'action_origin' => Historic::SYSTEM_ORIGIN,
                    'quantity' => $increasedQuantity
                ];
            } else {
                $decreasedQuantity = $stock->quantity - $request['quantity'];

                $historicData = [
                    'stock_id' => $stock->id,
                    'operation' => Historic::REMOVE_STOCK_QUANTITY_OPERATION,
                    'action_origin' => Historic::SYSTEM_ORIGIN,
                    'quantity' => $decreasedQuantity
                ];
            }

            $this->historicRepository->create($historicData);

            return redirect()->route('stocks.index')->with('status', 'Stock updated.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $stock = $this->stockRepository->getById($id);

            $this->stockRepository->deleteById($id);

            $historicData = [
                'stock_id' => $stock->id,
                'operation' => Historic::REMOVE_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::SYSTEM_ORIGIN,
                'quantity' => $stock->quantity
            ];

            $this->historicRepository->create($historicData);

            return redirect()->route('stocks.index')->with('status', 'Stock deleted.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }
}

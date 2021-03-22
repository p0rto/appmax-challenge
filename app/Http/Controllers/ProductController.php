<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\StockRepository;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $productRepository;
    private $stockRepository;
    private $stockController;

    public function __construct(
        ProductRepository $productRepository,
        StockRepository $stockRepository,
        StockController $stockController
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->stockController = $stockController;
    }

    public function index() : View
    {
        $products = $this->productRepository->all();

        return view('products.index')->with('products', $products);
    }

    public function create() : View
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $dataToStore = $request->validated();

            $this->productRepository->create($dataToStore);

            return redirect()->route('products.index')->with('status', 'Product created.');
        } catch (\Exception $exception) {
            return redirect()->route('products.index')->withErrors(['status', $exception->getMessage()]);
        }
    }

    public function show(int $id)
    {
        return redirect()->route('products.edit', ['product' => $id]);
    }

    public function edit(int $id) : View
    {
        $product = $this->productRepository->getById($id);

        return view('products.edit')->with('product', $product);
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            $this->productRepository->updateById($id, $request->validated());

            return redirect()->route('products.index')->with('status', 'Product updated.');
        } catch (\Exception $exception) {
            return redirect()->route('products.index')->withErrors(['status', $exception->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $stock = $this->stockRepository->getByColumn($id, 'product_id');

            if ($stock) {
                $this->stockController->destroy($stock->id);
            }

            $this->productRepository->deleteById($id);

            return redirect()->route('products.index')->with('status', 'Product deleted.');
        } catch (\Exception $exception) {
            return redirect()->route('products.index')->withErrors(['status', $exception->getMessage()]);
        }
    }
}

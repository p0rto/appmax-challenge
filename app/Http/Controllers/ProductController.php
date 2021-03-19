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

    public function __construct(
        ProductRepository $productRepository,
        StockRepository $stockRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
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
            $this->productRepository->create($request->validated());

            return redirect()->route('stocks.index')->with('status', 'Product created.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
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

            return redirect()->route('stocks.index')->with('status', 'Product updated.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->productRepository->deleteById($id);
            $this->stockRepository->getByColumn($id, 'product_id')->delete();

            return redirect()->route('stocks.index')->with('status', 'Product deleted.');
        } catch (\Exception $exception) {
            return redirect()->route('stocks.index')->withErrors(['status', $exception->getMessage()]);
        }
    }
}

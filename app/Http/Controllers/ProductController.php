<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
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

    public function store(StoreProductRequest $request) : JsonResponse
    {
        try {
            $newProduct = $this->productRepository->create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'New product registered.',
                'data' => $newProduct
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show(int $id) : JsonResponse
    {
        try {
            $product = $this->productRepository->getById($id);

            return response()->json([
                'success' => true,
                'message' => 'Request succeed',
                'data' => $product
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => $exception
            ]);
        }
    }

    public function edit(int $id) : View
    {
        $product = $this->productRepository->getById($id);

        return view('products.edit')->with('product', $product);
    }

    public function update(UpdateProductRequest $request, int $id) : JsonResponse
    {
        try {
            $product = $this->productRepository->updateById($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Product updated',
                'data' => $product
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => $exception
            ]);
        }
    }

    public function destroy(int $id) : JsonResponse
    {
        //
    }
}

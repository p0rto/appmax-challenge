<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyRequest;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\JsonResponse;

class ApiProductController extends Controller
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

    public function create(StoreProductRequest $request) : JsonResponse
    {
        try {
            $dataToStore = $request->validated();
            $dataToStore['action_origin'] = 'api';

            $createdProduct = $this->productRepository->create($dataToStore);

            return response()->json([
                'success' => true,
                'message' => 'Product created.',
                'data' => $createdProduct
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => $exception
            ]);
        }
    }

    public function destroy(DestroyRequest $request) : JsonResponse
    {
        try {
            $idToDestroy = $request->validated()["id"];

            $dataToUpdate['action_origin'] = 'api';
            $this->productRepository->updateById($idToDestroy, $dataToUpdate);
            
            $this->productRepository->deleteById($idToDestroy);
            $this->stockRepository->getByColumn($idToDestroy, 'product_id')->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted.',
                'data' => null
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => $exception
            ]);
        }
    }
}

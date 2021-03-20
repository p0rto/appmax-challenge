<?php

namespace App\Http\Controllers;

use App\Historic;
use App\Http\Requests\DestroyRequest;
use App\Repositories\HistoricRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use App\Stock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    private $productRepository;
    private $stockRepository;
    private $historicRepository;

    public function __construct(
        ProductRepository $productRepository,
        StockRepository $stockRepository,
        HistoricRepository $historicRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->historicRepository = $historicRepository;
    }

    public function decreaseQuantity(Request $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $stock = $this->makeDefaultValidations($data);

            $resultingQuantity = $stock->quantity - $data['quantity'];

            if ($resultingQuantity < 0) {
                throw new \Exception('Resulting quantity is less than zero');
            }

            $updatedStock = $this->stockRepository->updateById($stock->id, ['quantity' => $resultingQuantity]);

            $historicData = [
                'stock_id' => $stock->id,
                'operation' => Historic::REMOVE_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::API_ORIGIN,
                'quantity' => $data['quantity']
            ];

            $this->historicRepository->create($historicData);

            return response()->json([
                'success' => true,
                'message' => 'Stock quantity updated.',
                'data' => $updatedStock
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => $exception
            ]);
        }
    }

    public function increaseQuantity(Request $request) : JsonResponse
    {
        try {
            $data = $request->all();
            $stock = $this->makeDefaultValidations($data);

            $addedQuantity = $stock->quantity + $data['quantity'];

            $updatedStock = $this->stockRepository->updateById($stock->id, ['quantity' => $addedQuantity]);

            $historicData = [
                'stock_id' => $stock->id,
                'operation' => Historic::ADD_STOCK_QUANTITY_OPERATION,
                'action_origin' => Historic::API_ORIGIN,
                'quantity' => $data['quantity']
            ];

            $this->historicRepository->create($historicData);

            return response()->json([
                'success' => true,
                'message' => 'Stock quantity updated.',
                'data' => $updatedStock
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => $exception
            ]);
        }
    }

    private function makeDefaultValidations(array $requestData) : Stock
    {
        $validator = Validator::make($requestData, [
            'sku' => 'required|exists:products,sku|max:255',
            'quantity' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $stock = $this->productRepository->getByColumn($requestData['sku'], 'sku')->stock;

        if (!$stock) {
            throw new \Exception('Product is not on stock.');
        }

        return $stock;
    }
}

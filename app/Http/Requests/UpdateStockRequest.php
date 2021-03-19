<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $stockId = $this->route('stock');

        return [
            'product_id' => 'required|numeric|unique:stocks,product_id,' . $stockId,
            'quantity' => 'required|numeric'
        ];
    }
}
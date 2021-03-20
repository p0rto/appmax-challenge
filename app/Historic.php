<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historic extends Model
{
    public const SYSTEM_ORIGIN = 1;
    public const API_ORIGIN = 2;

    public const ADD_STOCK_QUANTITY_OPERATION = 1;
    public const REMOVE_STOCK_QUANTITY_OPERATION = 2;

    protected $fillable = [
        'stock_id',
        'operation',
        'action_origin',
        'quantity'
    ];

    public function stock() : BelongsTo
    {
        return $this->belongsTo(Stock::class)->withTrashed();
    }
}

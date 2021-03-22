<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'quantity'
    ];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function historic() : HasMany
    {
        return $this->hasMany(Historic::class);
    }
}

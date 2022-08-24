<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    // An order has many products
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                ->withPivot('total_price', 'total_quantity');
    }
}

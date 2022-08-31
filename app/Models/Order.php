<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    // I add a placeholder title in order to safeguard the order controller.
    protected $guarded = [];

    // An order belongs to a user.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // An order has many products
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                ->withPivot('total_price', 'total_quantity');
    }
}

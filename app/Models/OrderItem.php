<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class OrderItem extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $hidden = ['order', 'variant', 'product'];

    protected $appends = ['track_id', 'product_image', 'product_name', 'variant_image'];

    public function getTrackIdAttribute()
    {
        return $this->order?->order_id;
    }

    protected $casts = [
        'option_price' => 'float',
        'qty' => 'int'
    ];

    public function getProductImageAttribute()
    {
        return $this->product?->thumbnail_image;
    }

    public function getProductNameAttribute()
    {
        return $this->product?->name;
    }

    public function getVariantImageAttribute()
    {
        return $this->variant?->file_name;
    }
}

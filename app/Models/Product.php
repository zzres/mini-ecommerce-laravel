<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock', 'status', 'image'];

    // Relation produit->category. 1 produit appartienta une-seul category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relation produit-orderItem. 1 produit peut apparaitre dans +eurs ligne de commandes
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

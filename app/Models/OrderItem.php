<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id','quantity', 'unit_price'];

    //Relation OrderItem-order. 1 ligne appartient a une seul commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //Relation orderItem-produit. 1 ligne contient un seul produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

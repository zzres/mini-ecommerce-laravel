<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'total', 'address'];

    //Relation commande-user. 1 commande appartient a un seul utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relation order-orderItem. 1 commd contient +eurs ligne 
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

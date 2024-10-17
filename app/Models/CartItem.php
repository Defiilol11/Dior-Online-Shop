<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // Relación con carts
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relación con products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

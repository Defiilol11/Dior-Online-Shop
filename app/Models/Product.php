<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
    ];

    // Relación con cart_items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'status', // Estado del carrito
    ];

    // Relación con cart_items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relación con usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

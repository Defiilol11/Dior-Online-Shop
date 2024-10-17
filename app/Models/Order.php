<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'cart_id',
        'shipping_address_id',
        'status',
        'payment_method',
    ];

    // Relación con usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relación con address
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'name');
    }
}


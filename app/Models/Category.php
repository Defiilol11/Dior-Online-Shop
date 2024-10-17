<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'name',
        'description', // Opcional, si deseas agregar una descripción
    ];

    // Relación con products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

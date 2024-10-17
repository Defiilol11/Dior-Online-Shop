<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'address_line',
        'latitude',
        'longitude',
    ];

    // Relación con usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

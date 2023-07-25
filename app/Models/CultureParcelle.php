<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultureParcelle extends Model
{
    use HasFactory;
     protected $table = 'culture_parcelles';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const  PK = 'id';  
}

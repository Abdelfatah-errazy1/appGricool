<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mesurequantification extends Model
{
    use HasFactory;
    protected $table = 'mesure_quantification';
    public $primaryKey = 'idMQ';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const  PK = 'idMQ';  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeExecution extends Model
{
    use HasFactory;
    protected $table = 'charge_execution';
    public $primaryKey = 'idCE';
    public $incrementing = true;
    protected $keyType = 'int';
    public const  PK = 'idCE';
    public $timestamps = false;
}

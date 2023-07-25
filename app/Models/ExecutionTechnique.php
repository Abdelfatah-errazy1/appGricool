<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutionTechnique extends Model
{
    use HasFactory;
    protected $table = 'execution_technique_spe';
    public $primaryKey = 'idETS';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    public const  PK = 'idETS';  
}

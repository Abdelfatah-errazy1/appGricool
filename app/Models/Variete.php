<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\StadeVarieteController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variete extends Model
{
    use HasFactory;
     protected $table = 'varietes';
     public $primaryKey = 'idV';
    public $incrementing = true;
    protected $keyType = 'int';
     public const PK = 'idV';
     public $timestamps = true;

    //  public function especes(): BelongsTo
    //  {
    //     return $this->belongsTo(EspecesModel::class);
    //  }

     public function stadevarietes()
     {
         return $this->hasMany(StadeVariete::class, 'variete');
     }

     public static function allForSelect()
     {
         return self::query()
             ->select('varietes.'.self::PK, DB::raw('CONCAT(varietes.nomCommercial ) as variete_nom'))
             ->get();
     }
}

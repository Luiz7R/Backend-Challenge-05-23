<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class ApiDetails extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'apidetails';

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'memoria_consumida',
        'status',
        'data_importacao',
        'tempo_execucao'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getTempoExecucaoAttribute() 
    {
       return $this->formatarTempoExecucao($this->attributes['tempo_execucao']);
    }

    public function getCreatedAtAttribute() 
    {
       $createdAt = $this->attributes['created_at']->toDateTime();

       return Carbon::parse($createdAt)->diffForHumans();
    }

    public function formatarTempoExecucao($valor)
    {
        if ( $valor < 1000 ) 
        {
            return round($valor, 1) . "ms";
        }
        else if ( $valor < 60000 ) 
        {
            return round($valor / 1000, 1) . "s";
        }
        else 
        {
            return round($valor / 60000, 2) . "m";
        }
    }
}

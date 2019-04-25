<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmauto extends Model
{
    protected $table = 'mpmx_cmautos';

    protected $fillable = [
    						'fecha', 
    						'medio', 
    						'poliza', 
    						'prima_neta', 
    						'forma_de_pago',
    						'cobertura',
    						'observaciones',
    						'c_id',
    						'renovaciones',
    						'estatus',
    						'gestor_de_cobro',
    						'agente',
    						'prima_total',
    						'nombre',
    						'telefono',
    						'correo_electronico',
    						'vehiculo',
    						'num_serie',
    						'status'
    					];
}

<?php

namespace App\Imports;

use App\Cmauto;
use App\Http\Traits\ExcelTimeTrait;
use Maatwebsite\Excel\Concerns\ToModel;

class CmautoImport implements ToModel
{
  use ExcelTimeTrait;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }

        return new Cmauto([
                            'fecha'               =>  $this->excel_to_timestamp( $row[0], "Y-m-d"),  
                            'medio'               => $row[1], 
                            'poliza'              => $row[2], 
                            'prima_neta'          => $row[3], 
                            'forma_de_pago'       => $row[4],
                            'cobertura'           => $row[5],
                            'observaciones'       => $row[6],
                            'c_id'                => $row[7],
                            'renovaciones'        => $row[8],
                            'estatus'             => $row[9],
                            'gestor_de_cobro'     => $row[10],
                            'agente'              => $row[11],
                            'prima_total'         => $row[12],
                            'nombre'              => $row[13],
                            'telefono'            => $row[14],
                            'correo_electronico'  => $row[15],
                            'vehiculo'            => $row[16],
                            'num_serie'           => $row[17],
                            'status'              => 1
                          ]);   
    }
}

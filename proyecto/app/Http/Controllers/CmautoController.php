<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cmauto;
use App\Http\Traits\FileTrait;
use App\Imports\CmautoImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class CmautoController extends Controller
{
	use FileTrait;

    public function index()
    {
    	return view('welcome');
    }

    /**
     * Importa Excel de Cmautos a la BD
     */
    public function import(Request $request) 
    {
        // Validar que el archivo sea Excel
        $validator = Validator::make($request->all(),[
                                        'archivo_excel' => 'required|file|mimes:xls,xlsx'
                                    ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        
        // Ruta donde se almacenará el archivo
        $ruta = 'app';

        // Almacenar archivo en Storage
        $nombre_archivo = $this->newFile($ruta, $request->archivo_excel);

        // Realizar import a BD
        try {
            // Lee el archivo .xlsx desde Storage/app
            Excel::import(new CmautoImport, $nombre_archivo);
        } catch (\Exception $e) {
            \Log::info($e);
        	// Eliminar archivo de Storage
        	$this->deleteFile( $ruta . '/' . $nombre_archivo );

        	// Generar mensajes de error 
            $status     = 'Revisar que el archivo coincida con el formato especificado. ' . $e->getMessage();
            $error      = true; 
            
            return redirect()->back()->with(compact('status', 'error'));
        }

        // En caso de que el excel sí proceda, 
        // eliminar los registros previos 
        Cmauto::truncate();

        // subir nuevos registros
        Excel::import(new CmautoImport, $nombre_archivo);
        $this->deleteFile( $ruta . '/' . $nombre_archivo );

        // Genera mensaje para el usuario
        $status     = 'Las preguntas se han cargado correctamente.';
        $error      = false; 

        return redirect()->back()->with(compact('status', 'error'));
    }

    public function messages()
    {
    	$messages = [
    					'archivo_excel.required' => 'El archivo excel es requerido.',
    					'archivo_excel.mimes' => 'El archivo debe contener la extensión .xls o .xlsx'
    				];

    	return $messages;
    }

}

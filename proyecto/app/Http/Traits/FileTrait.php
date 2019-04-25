<?php

namespace App\Http\Traits;

/**
* Trait destinado para manejo de archivos en todo el sistema
*/
trait FileTrait {

    /**
     * Comprueba si la carpeta existe
     * si existe borra su contenido, de lo contrario la crea
     */
    public function checkDestinationPath ( $destinationPath )
    {
        ( \File::exists( $destinationPath ) ) ? \File::cleanDirectory( $destinationPath ) : \File::makeDirectory( $destinationPath, 0777, true );

        return true;
    }

    /**
     * Convierte el nombre de un archivo a un slug
     * @param $nombre nombre archivo, $extension extension del archivo 
     * @return slugified name
     */
    public function slugFileName($nombre, $extension)
    {
        return str_slug(basename($nombre, '.'.$extension), '-') . '.'.$extension;
    }

    /**
     * Crea directorio y almacena el archivo
     * @param $destinationPath es la ruta donde se almacenará, $file es el archivo como se recibe en el request
     * @return true
     */
    public function moveFile($destinationPath, $file)
    {
        // 1) Genera el nombre del archivo
        $file_name = $this->slugFileName($file->getClientOriginalName(), $file->getClientOriginalExtension());

        // 2) Crea el directorio
        ( !\File::exists( $destinationPath ) ) ? \File::makeDirectory( $destinationPath, 0777, true ) : true;

         // 3) Almacena archivo
        $file->move($destinationPath, $file_name);

        return true;
    }

    /**
     * Almacena el nuevo archivo
     * @param $ruta donde se almacenará, $archivo a almacenar
     * @return $nombre del archivo
     */
    public function newFile($ruta, $archivo)
    {
        // Genera el nombre del archivo como un slug
        $nombreArchivo = $this->slugFileName($archivo->getClientOriginalName(), $archivo->getClientOriginalExtension());

        // Genera ruta del archivo para almacenar el archivo
        $destinationPath = storage_path( strtolower($ruta) );

        // Verifica que la carpeta exista, de lo contrario la crea
        ( !\File::exists( $destinationPath ) ) ? \File::makeDirectory( $destinationPath, 0777, true ) : true;

         // Almacena archivo
        $archivo->move($destinationPath, $nombreArchivo);

        return $nombreArchivo;
    }

    /**
     * Eliminar archivos
     *  @param $archivo ubicacion del archivo a eliminar
     *  @return true
     */
    public function deleteFile($archivo)
    {
        // Define la ruta del archivo que se eliminará
        $archivo_eliminar = storage_path( strtolower($archivo) );

        //Eliminar archivo correspondiente al registro
        if ( \File::exists($archivo_eliminar) ) {  
            \File::delete($archivo_eliminar);
        }
        
        return true;
    }
}
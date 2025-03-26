<?php 

require_once __DIR__ .'/entity/Fichero.php';



interface FicherosDBInt{


    /**
     * Recupera la lista de archivos asociados a una tarea especifica
     * 
     * @param int $id_tarea
     * @return void
     */
    public function listaFicheros(int $id_tarea);


    /**
     * busca un archivo por su id
     * 
     * @param int $id
     * @return void
     */
    public function buscaFichero(int $id) ;

    /**
     * Summary of borraFichero eliminar fichero por su ID.
     * @param int $id
     * @return void
     */
    public function borraFichero(int $id);


    public function nuevoFichero(Fichero $fichero);


}
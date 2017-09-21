<?php
use FWAP\Database\Drives\iDatabase;

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 16/09/17
 * Time: 06:41
 */
class IndexModel
{

    private $entity;

    public function __construct(iDatabase $database)
    {
        $this->entity = $database;

    }


    public function getAll() {

        return $this->entity->select( 'Carro inner join Proprietario on Carro.Proprietario_id = Proprietario.id ', '*', '');
    }

    public function searchCarro($matricula) {
        return $this->entity->selectManager("SELECT * FROM Carro inner join Proprietario on Carro.Proprietario_id = Proprietario.id INNER JOIN localizacao on Carro.id = localizacao.Carro_id WHERE Matricula =  '".$matricula."'" );
    }

    public function getFotoCarro($valor) {

        return $this->entity->selectManager("SELECT * FROM Foto inner join Carro on Foto.Carro_id = Carro.id  WHERE Matricula =  '".$valor."'" . "ORDER BY Foto.id DESC");
    }


}
<?php
use FWAP\Database\Drives\iDatabase;
use FWAP\Database\iDBconnection;

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 17/09/17
 * Time: 08:45
 */
class InsertDadosForDenunciaModel
{
    /**
     * @var iDatabase
     */
    private $database;

    /**
     * @var iDBconnection
     */

    public function __construct(iDatabase $database)
    {
    $this->database = $database;}


    public function insertCarro($data)
    {
        $this->database->insert('Matricula', $data);

    }

    public function insertMotor($data)
    {
        $this->database->insert('Motor', $data);

    }

    public function insertFoto($data)
    {
        $this->database->insert('Foto', $data);

    }

}
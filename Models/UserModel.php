<?php

/**
 *
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 2016/02/14
 * Time: 1:34 PM
 */
use \FWAP\Helpers\interfaceSql;
use FWAP\Database\Drives\iDatabase;

class UserModel {

    private $entity;

    public function __construct(iDatabase $entity) {

        $this->entity = $entity;
    }

    /**
     * @param $data
     * @return bool
     */
    public function signUp($data) {
         $this->entity->insert('Proprietario', $data);
    }

    /**
     * @param $data
     * @return array
     *  select all from usuarios
     */
    public function signIn($data) {
        return $this->entity->selectManager("SELECT * FROM Proprietario WHERE usuario=:usuario", $data);
    }

    /**
     * @param $data
     * @return array
     */
    public function selectData($data) {
        return $this->entity->selectManager("SELECT * FROM Proprietario WHERE usuario=:usuario", $data);
    }

}

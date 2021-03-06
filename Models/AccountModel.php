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
use FWAP\Database\Drives\iDatabase;

class AccountModel {
    /**
     * @var interfaceModel instanciando o BD
     */
//    private $m;

    /**
     * @var iDatabase instanciando o BD
     */
    private $entity;

    public function __construct(iDatabase $entity) {

        $this->entity = $entity;
    }

    /**
     * @param $id id for user selected by session
     * @return array
     */
    public function getUser($id) {
        return $this->entity->selectManager('SELECT * FROM Proprietario WHERE id =:id', ["id" => $id]);
    }

    public function getusers($user) {
        return $this->entity->selectManager("SELECT * FROM Proprietario WHERE usuario=:usuario", ["username" => $user]);
    }

    public function getAllUser() {

        return $this->entity->selectManager("SELECT * FROM  Proprietario INNER JOIN pic_perfil on
            pic_perfil.usuarios_id = Proprietario.id  ORDER BY usuarios.id DESC" );
    }

    /**
     * @param $data
     * @param $id
     */
    public function updates($data, $id) {
         $this->entity->update('usuarios', $data, "id=" . $id);
    }

    public function deletes($id) {
        $this->entity->delete('usuarios', "id=$id", 1);
    }

    public function insertImage($data) {
         $this->entity->insert('photographer', $data);
    }

    public function getImage($id) {

        return $this->entity->selectManager('SELECT * FROM usuarios inner join photographer on usuarios.id= photographer.id_user AND  photographer.id_user = usuarios.id ');
    }

    /**
     * update the role of users
     *
     * @return data, id
     * @author 
     * */
    public function manageUser($data, $id) {
        return $this->entity->update('usuarios', $data, "id=" . $id);
    }

    /**
     * update the role of users
     *
     * @return data, id
     * @author 
     * */
    public function managePassword($data, $id) {
         $this->entity->update('usuarios', $data, "id=" . $id);
    }

    public function insertImageUser($data) {
         $this->entity->insert('pic_perfil', $data);
    }

    public function getImageUser($id) {
        return $this->entity->selectManager("SELECT pic_perfil.* FROM pic_perfil INNER JOIN usuarios on
            pic_perfil.usuarios_id = usuarios.id WHERE usuarios.id = $id  ORDER BY usuarios_id DESC");
    }

    public function getImageUserDelete() {
        return $this->entity->selectManager("SELECT * FROM pic_perfil inner join usuarios on pic_perfil.usuarios_id = usuarios.id WHERE pic_perfil.usuarios_id ORDER BY pic_perfil.id  ");
    }

    public function deleteImagePerfil($id) {
         $this->entity->delete('pic_perfil', "usuarios_id=$id", 1);
    }

    public function getMural($id) {
        return $this->entity->selectManager("SELECT * FROM mural INNER JOIN usuarios ON
                mural.usuarios_id = usuarios.id WHERE mural.usuarios_id = $id ORDER BY mural.id DESC");
    }

    public function getResMural() {
        return $this->entity->selectManager("SELECT * FROM res_mural INNER JOIN mural on res_mural.id_m =mural.id WHERE mural.id ");
    }

    public function getMuralById($id) {
        return $this->entity->selectManager("SELECT mural.id FROM mural inner join usuarios on mural.usuarios_id = usuarios.id WHERE usuarios.id = $id");
    }

    public function insertMural($data) {
        return $this->entity->insert('mural', $data);
    }

    public function insertRespo($data) {
        return $this->entity->insert('res_mural', $data);
    }

}

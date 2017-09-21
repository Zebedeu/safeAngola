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
 * @link      http://github.com/----/--- for the canonical source repository
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */
use FWAP\Core\Controller\Controller;
use FWAP\Helpers\Http\Hook;
use FWAP\Helpers\Security\Session;
use FWAP\Helpers\Security\Hash;
use FWAP\Helpers\Ucfirst;

class Account extends Controller {

    private $files;
    private $path;
    private $tmp;
    public $name;
    public $size;
    public $type;

    public function __construct() {

        parent::__construct();
        $this->view->Js = array('Cpanel/Js/default.js');
    }

    /**
     *
     */
    public function index() {

        $this->view->title = "LISTA USERS";
        $this->view->users = $this->model->getAllUser();
        $this->view->render($this, 'index');

    }

    public function Cpanel()
    {
        if (!Session::exist()) {
            Hook::Header('User');
        }
        $this->view->title = "Cpanel";
//            $this->view->c = $this->model->getImage(Session::get("ID"));
        if ($this->model->getImageUser(Session::get("ID"))) {
            $this->view->UserPhoto = $this->model->getImageUser(Session::get("ID"))[0];
        }

        $this->view->render($this, 'cpanel');
    }

    public function imageUser() {
        $this->view->UserData = $this->model->getUser(Session::get("ID"))[0];
        $this->view->render($this, 'insertImageUser');
    }

    public function insertImageUser() {
        $this->imagem->file('perfil');
        if(! empty($this->model->getImageUser(Session::get('ID')[0]) ) ) {
            Hook::Header('account/cpanel');

        }


            if (!empty($_POST['usuarios_id'])) {

            $data['type'] = $this->imagem->type;
            $data['size'] = $this->imagem->size;
            $data['path'] = $this->imagem->path;
            $data['name'] = $this->imagem->name;
            $data['usuarios_id'] = $_POST['usuarios_id'];
            $this->model->insertImageUser($data);


            Hook::Header('account/cpanel');

        }else {
            Hook::Header('account/cpanel');
        }
    }

    public function edit() {
        if (! Session::exist()) {
            $this->view->render($this, 'index');
            header('location:' . URL);
        }
            $this->view->UserData = $this->model->getUser(Session::get("ID"))[0];
            if ($this->model->getImageUser(Session::get("ID") )) {
                $this->view->UserPhoto = $this->model->getImageUser(Session::get("ID"))[0];
            } $this->view->render($this, 'edit');

    }

    public function deletes($id) {
        if (! Session::exist()) {
            Hook::Header('user/signUp');
        }

                $this->model->deletes($id);
                Session::Destroy();
                Hook::Header('user/signUp');


    }

    public function updates() {
        if ($_POST['id']) {

            $data["firstname"] = Ucfirst::_ucfirst(htmlspecialchars($_POST['firstname']));
            $data["lastname"] = Ucfirst::_ucfirst(htmlspecialchars($_POST['lastname']));
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data["telephone"] = $_POST["telephone"];
            $data["company"] = $_POST["company"];
            $data["address_1"] = $_POST["address_1"];
            $data["address_2"] = $_POST["address_2"];
            $data["postcode"] = $_POST["postcode"];
            $data['zone_id'] = $_POST['zone_id'];
            $data['city'] = $_POST['city'];
            $data['country_id'] = $_POST['country_id'];


             $this->model->updates($data, $_POST['id']);
        }
        Hook::Header('account/cpanel');

    }

    public function deleteImage($id)
    {
        if (!Session::exist()) {
            return Hook::Header('');
        }
            $file = $this->model->getImageUser($id);

            if (!is_array($file)) {
                return false;
            }

            unlink($file[0]['path']);
            $this->model->deleteImagePerfil($id);
            Hook::Header('account/cpanel');

    }

    public function profile($id) {
        $this->view->title = "LISTA USERS";
        if ($id != null) {

            $this->view->UserPhoto = $this->model->getImageUser($id);
            $this->view->resmural = $this->model->getResMural();
            $this->view->getMuralById = $this->model->getMuralById($id);
            $this->view->mural = $this->model->getMural($id);
            $this->view->users = $this->model->getUser($id);
        } else {
            Hook::Header('Account');
        }
        $this->view->render($this, 'profile');
    }

    public function insertMural() {

            $valid = new \FWAP\Helpers\Validate();
            $valid->getMethod('POST')->post('usuarios_id')->post('message');

            $this->model->insertMural($valid->getPostDate());

    }

    public function insertRespo() {

    $valid = new \FWAP\Helpers\Validate();
    $valid->getMethod('POST')->post('message')->post('mural_id');
    $this->model->insertRespo($valid->getPostDate());

    }

    /**
     * update the role of users
     *
     * @return data, id
     * @author 
     * */
    public function manageUser() {
        if ($_POST['id']) {
            $data['role'] = $_POST['role'];
            return $this->model->manageUser($data, $_POST['id']);
        } else {
            echo "NADA FOI ATUALIZADO";
        }
    }

    /**
     * update the role of users
     *
     * @return data, id
     * @author 
     * */
    public function password() {
        $this->view->UserData = $this->model->getUser(Session::get("ID"))[0];
        $this->view->render($this, 'password');
    }

    /**
     * update the role of users
     *
     * @return data, id
     * @author 
     * */
    public function managePassword() {
        if ($_POST['id'] ) {

            $data['password'] = Hash::Create(ALGO, $_POST['password'], HASH_KEY);
             $this->model->managePassword($data, $_POST['id']);
        } else {
            echo "NADA FOI ATUALIZADO  porque a password antiga nao existe";
        }
    }





}

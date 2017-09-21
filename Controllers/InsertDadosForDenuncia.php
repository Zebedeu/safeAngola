<?php
use FWAP\Core\Controller\Controller;
use FWAP\Helpers\Security\Validate;

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 17/09/17
 * Time: 08:30
 */
class InsertDadosForDenuncia extends Controller
{


    public function index()
    {
        $this->view->title = "Inserir";
        $this->view->render($this, 'index');

    }

    public function insert()
    {

        $form = new Validate();
        $form->setMethod('POST');
        $form->post('matriNum')->val('maxLength', 2);

        $carro = $form->getPostDate();
        $d = $this->model->insertCarro($carro);

        var_dump($d);
    }

    public function insertFoto()
    {


        $this->imagem->file('Carro');

        if (!empty($_POST['Carro_id'])) {

            $data['type'] = $this->imagem->type;
            $data['size'] = $this->imagem->size;
            $data['path'] = $this->imagem->path;
            $data['name'] = $this->imagem->name;
            $data['Carro_id'] = $_POST['Carro_id'];
            $m = $this->model->insertFoto($data);
            var_dump($m);

        }


    }

}
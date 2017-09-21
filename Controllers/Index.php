<?php
use FWAP\Core\Controller\Controller;


class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // busca //
        $this->view->title = "Cidadão | Home";
        $this->view->render($this, 'index');

    }

    public function procurar()
    {
        if (! empty($_POST['type'])) {
            $type = $_POST['type'];
            switch ($type) {
                case 'carro':

                    if(!empty($_POST['valor'])) {
                        $valor = $_POST['valor'];
                        $this->view->carro = $this->model->searchCarro($valor);
                        $this->view->foto = $this->model->getFotoCarro($valor);
                        $this->view->render($this, 'SerachCarr');

                    }

                    break;
                case 'pessoa':
                    echo 'value2<br/>';
                    break;
                case 'crimes':
                    echo 'value2<br/>';
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
}

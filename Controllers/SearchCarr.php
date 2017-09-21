<?php

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 17/09/17
 * Time: 08:25
 */
class SearchCarr
{
    public function procurar()
    {
        if (! empty($_POST['type'])) {
            $select1 = $_POST['type'];
            switch ($select1) {
                case 'carro':

                    if(!empty($_POST['valor'])) {
                        $valor = $_POST['valor'];
                        $this->view->carro = $this->model->searchCarro($valor);
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
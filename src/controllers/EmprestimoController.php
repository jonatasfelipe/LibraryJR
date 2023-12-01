<?php

namespace src\controllers;
use src\models\EmprestimoModel;

class EmprestimoController {
    private $emprestimoModel;

    public function __construct($pdo) {
        $this->emprestimoModel = new EmprestimoModel($pdo);
    }

    public function criarEmprestimo($nome,$modalidade, $ano_olimpiada) {
        $this->emprestimoModel->criarEmprestimo($nome,$modalidade, $ano_olimpiada);
    }

    public function listarEsportes() {
        return $this->emprestimoModel->listarEsportes();
    }

    public function exibirListaEsportes() {
        $emprestimos = $this->emprestimoModel->listarEsportes();
        include 'views/esportes/lista.php';
    }
}

    
?>


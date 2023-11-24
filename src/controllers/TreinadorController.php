<?php

namespace src\controllers;
use src\models\TreinadorModel;

class TreinadorController {
    private $esporteModel;

    public function __construct($pdo) {
        $this->esporteModel = new TreinadorModel($pdo);
    }

    public function criarEsporte($nome,$modalidade, $ano_olimpiada) {
        $this->esporteModel->criarEsporte($nome,$modalidade, $ano_olimpiada);
    }

    public function listarEsportes() {
        return $this->esporteModel->listarEsportes();
    }

    public function exibirListaEsportes() {
        $esportes = $this->esporteModel->listarEsportes();
        include 'views/esportes/lista.php';
    }
}

    
?>


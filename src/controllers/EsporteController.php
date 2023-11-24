<?php

namespace LibraryJr\controllers;

use LibraryJr\models\EsporteModel;

class EsporteController
{
    private $esporteModel;

    public function __construct($pdo)
    {
        $this->esporteModel = new EsporteModel($pdo);
    }

    public function criarEsporte($nome, $modalidade, $ano_olimpiada)
    {
        $this->esporteModel->criarEsporte($nome, $modalidade, $ano_olimpiada);
    }

    public function listarEsportes()
    {
        return $this->esporteModel->listarEsportes();
    }

    public function exibirListaEsportes()
    {
        $esportes = $this->esporteModel->listarEsportes();
        include 'views/esportes/lista.php';
    }
}

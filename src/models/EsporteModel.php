<?php

namespace LibraryJr\models;
use PDO;

class EsporteModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarEsporte($nome, $modalidade, $ano_olimpiada)
    {
        $sql = "INSERT INTO esporte (nome, modalidade, ano_olimpiada) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $modalidade, $ano_olimpiada]);
    }

    public function listarEsportes()
    {
        $sql = "SELECT * FROM esporte";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Implementar métodos para atualizar e excluir esportes
}

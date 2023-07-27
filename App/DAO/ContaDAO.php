<?php

namespace App\DAO;

use App\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO
{
    public function __construct()
    {   
        parent::__construct();
    }

    public function insert(ContaModel $model) : ?ContaModel
    {
        $sql = "INSERT INTO conta (id_cliente, saldo, limite, tipo, data_abertura) VALUES (?, ?, ?, ?, NOW())";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id_cliente);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->tipo);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function select(int $id_cliente)
    {
        $sql = "SELECT * FROM conta WHERE id_cliente = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_cliente);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
}
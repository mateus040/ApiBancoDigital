<?php

namespace App\DAO;

use App\Model\TransacaoModel;
use \PDO;

class TransacaoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(TransacaoModel $model)
    {
        $sql = "INSERT INTO transacao (data_transacao, valor, id_conta_enviou, id_conta_recebeu) VALUE (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->data_transacao);        
        $stmt->bindValue(2, $model->valor);        
        $stmt->bindValue(3, $model->id_conta_enviou);     
        $stmt->bindValue(4, $model->id_conta_recebeu);               

        $stmt->execute();
    }

    public function select(int $id)
    {
        $sql = "SELECT * FROM transacao WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

}
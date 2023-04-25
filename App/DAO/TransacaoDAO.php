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
        $sql = "INSERT INTO transacao (data_transacao, valor, id_conta_remetente, id_conta_destinatario) VALUE (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->data_transacao);        
        $stmt->bindValue(2, $model->valor);        
        $stmt->bindValue(3, $model->id_conta_remetente);     
        $stmt->bindValue(4, $model->id_conta_destinatario);               

        $stmt->execute();
    }

    public function update(TransacaoModel $model)
    {
        $sql = "UPDATE transacao SET data_transacao = ?, valor = ?, id_conta_remetente = ?, id_conta_destinatario = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
   
        $stmt->bindValue(1, $model->data_transacao);
        $stmt->bindValue(2, $model->valor);
        $stmt->bindValue(3, $model->id_conta_remetente);
        $stmt->bindValue(4, $model->id_conta_destinatario);
        $stmt->bindValue(5, $model->id);

        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM transacao";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById(int $id)
    {
        /*$sql = "SELECT cp.*, co.nome as conta_nome
                FROM transacao cp
                JOIN conta c ON c.id = cp.id_conta
                JOIN correntista co ON co.id = c.id_correntista
                WHERE cp.id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();

        return $stmt->fetchObject("App\Model\TransacaoModel"); */
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM transacao WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        
        $stmt->execute();
    }
}
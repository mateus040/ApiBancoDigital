<?php

namespace App\DAO;

use App\Model\CorrentistaModel;
use \PDO;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();   
    }

    public function save(CorrentistaModel $m) : CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }

    private function insert(CorrentistaModel $model)
    {
        $sql = "INSERT INTO correntista (nome, email, cpf, data_nasc, senha) VALUES (?, ?, ?, ?, sha1(?))";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->email);
        $stmt->bindValue(3, $model->cpf);
        $stmt->bindValue(4, $model->data_nasc);
        $stmt->bindValue(5, $model->senha);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    /*public function select()
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }*/
    
    private function update(CorrentistaModel $model)
    {
        /*$sql = "UPDATE correntista SET nome=?, cpf=?, data_nasc=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->data_nasc);
        $stmt->bindValue(4, $model->senha);
        $stmt->bindValue(5, $model->id);
        
        return $stmt->execute();*/
    }

    public function selectByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = sha1(?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        $obj = $stmt->fetchObject("App\Model\CorrentistaModel");

        return is_object($obj) ? $obj : new CorrentistaModel();
    }

    /*public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }*/
}
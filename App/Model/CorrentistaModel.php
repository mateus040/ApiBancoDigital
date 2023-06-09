<?php

namespace App\Model;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $id, $nome, $email, $cpf, $data_nasc, $senha;

    public function save() : ?CorrentistaModel
    {
        return (new CorrentistaDAO())->save($this);
    }

    public function getByCfpAndSenha($cpf, $senha) : CorrentistaModel
    {
        return (new CorrentistaDAO())->selectByCpfAndSenha($cpf, $senha);
    }

    /*public function save()
    {
        $dao = new CorrentistaDAO();

        if($this->id == null)
            $dao->insert($this);
        else
            $dao->update($this);
    }

    public function getAllRows()
    {
        $dao = new CorrentistaDAO();

        $this->rows = $dao->select();
    }

    public function delete(int $id)
    {
        $dao = new CorrentistaDAO();

        $dao->delete($id);
    }

    public function getById(int $id)
    {
        $dao = new CorrentistaDAO();

        $this->rows = $dao->selectById($id);
    }*/
}
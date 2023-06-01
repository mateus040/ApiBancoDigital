<?php

namespace App\Model;

use App\DAO\TransacaoDAO;

class TransacaoModel extends Model
{
    public $id, $data_transacao, $valor, $id_conta_enviou, $id_conta_recebeu;

    public function save()
    {
        $dao = new TransacaoDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        }
        else
        {
            //dao->update($this);
        }
    }

    public function getAllRows(int $id)
    {
        $dao = new TransacaoDAO();

        $this->rows = $dao->select($id);
    }
}
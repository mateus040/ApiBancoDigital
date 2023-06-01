<?php

namespace App\Model;

use App\DAO\ContaDAO;

class ContaModel extends Model
{
    public $id, $id_cliente, $saldo, $limite, $tipo, $data_abertura;

    public function save()
    {
        $dao = new ContaDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        }
        else
        {
            //$dao->update($this);
        }
    }

    public function getAllRows(int $id_cliente)
    {
        $dao = new ContaDAO();

        $this->rows = $dao->select($id_cliente);
    }
}
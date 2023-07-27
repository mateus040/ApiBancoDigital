<?php

namespace App\Model;

use App\DAO\ContaDAO;
use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $id, $nome, $email, $cpf, $data_nasc, $senha;
    public $rows_contas; // Array de objetos ContaModel

    public function save() : ?CorrentistaModel
    {
        $dao_correntista = new CorrentistaDAO();

        $model_preenchido = $dao_correntista->save($this);

        // Se o insert do correntista deu certo, vamos inserir sua conta corrente e poupança
        if($model_preenchido->id != null)
        {
            $dao_conta = new ContaDAO();

            // Abrindo a conta corrente
            $conta_corrente = new ContaModel();
            $conta_corrente->id_cliente = $model_preenchido->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;

            // Abrindo a conta poupanca
            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_cliente = $model_preenchido->id;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }

        return $model_preenchido;
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
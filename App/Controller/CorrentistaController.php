<?php

namespace App\Controller;

use App\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller
{
    public static function login()
    {
        try
        {
            $data = json_encode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            parent::getResponseAsJSON($model->getByCfpAndSenha($data->Cpf, $data->Senha));
        }
        catch(Exception $e)
        {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function save() : void
    {
        try
        {
            $data = json_encode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            foreach (get_object_vars($data) as $key => $value)
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;

                parent::getExceptionAsJSON($model->save());
            }
        }
        catch(Exception $e)
        {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    /*public static function listar() : void
    {
        
    }

    public static function delete() : void
    {

    }*/
}
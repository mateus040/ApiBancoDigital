<?php

use App\Controller\
{
    ChavePixController,
    ContaController,
    CorrentistaController,
    TransacaoController
};


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    /*case '/correntista/save':
        CorrentistaController::save();
    break;

    case '/correntista/entrar':
        CorrentistaController::entrar();
    break;

    case '/conta/pix/enviar':
        ChavePixController::enviar();  ou ContaController 
    break;

    case '/conta/pix/receber':
        ChavePixController::receber();  ou ContaController 
    break;
    
    case '/conta/extrato':
        ContaController::extrato();
    break; */

    /* Rota não identificada */
    default:
        http_response_code(403);
    break;
}
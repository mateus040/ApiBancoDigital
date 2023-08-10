<?php

use App\Controller\
{
    ChavePixController,
    ContaController,
    CorrentistaController,
    TransacaoController
};


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    // Backup
    case '/exportar':
        $return_var = NULL;
        $output = NULL;
        $command = 'C:/"Program Files"/MySQL/"MySQL Server 8.0"/bin/mysqldump -uroot -petecjau -P3307 -hlocalhost db_bancodigital > C:/Dev/file.sql';
        exec($command, $output, $exit_code);
        
        echo "Backup realizado com sucesso.";
    break;

    // Correntista
    case '/correntista/salvar':
        CorrentistaController::salvar();
    break;

    case '/correntista/entrar':
        CorrentistaController::login();
    break;

    // Conta
    case '/conta/abrir':
        ContaController::abrir();
    break;

    case '/conta/fechar':
        ContaController::fechar();
    break;

    case '/conta/extrato':
        ContaController::extrato();
    break;

    // Transação
    case '/transacao/pix/receber':
        TransacaoController::receberPix();
    break;

    case '/transacao/pix/enviar':
        TransacaoController::enviarPix();
    break;

    // Chave Pix
    case '/pix/chave/salvar':
        ChavePixController::salvar();
    break;

    case '/pix/chave/remover':
        ChavePixController::remover();
    break;


    default:
        header('HTTP/1.0 403 Forbidden');
    break;
}
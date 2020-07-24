<?php
include_once('clientes.php');

if (!empty($_REQUEST['nome'])) {
    $clientes = new Clientes();
    $clientes->__set('idcliente', $_REQUEST['idcliente']);
    $clientes->__set('nome', utf8_decode($_REQUEST['nome']));
    $clientes->__set('email', utf8_decode($_REQUEST['email']));
    $clientes->__set('telefone', utf8_decode($_REQUEST['telefone']));
    if (isset($_REQUEST['ativo'])) {
        $clientes->__set('ativo', 's');
    } else {
        $clientes->__set('ativo', 'n');
    }
    $dataAgora = date('Y/m/d H:i:s', time());
    $clientes->__set('datamodificacao', $dataAgora);
    
    if ($clientes->updateClientes()) {
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Cliente alterado com sucesso!'
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Ocorreu um erro ao tentar alterar o cliente.'
        );
    }
} else {
    $dados = array(
        'tipo' => 'info',
        'mensagem' => 'Você não pode deixar campo vazio.'
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
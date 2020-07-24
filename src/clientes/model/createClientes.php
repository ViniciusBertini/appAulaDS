<?php
include_once('clientes.php');

if (!empty($_REQUEST['nome']) && 
    !empty($_REQUEST['email']) && 
    !empty($_REQUEST['telefone'])) {
    $clientes = new Clientes();
    $clientes->__set('nome', utf8_decode($_REQUEST['nome']));
    $clientes->__set('email', utf8_decode($_REQUEST['email']));
    $clientes->__set('telefone', utf8_decode($_REQUEST['telefone']));
    if (isset($_REQUEST['ativo'])) {
        $clientes->__set('ativo', 's');
    } else {
        $clientes->__set('ativo', 'n');
    }
    $dataAgora = date('Y/m/d H:i:s', time());
    $clientes->__set('datacriacao', $dataAgora);
    $clientes->__set('datamodificacao', $dataAgora);
    
    if ($clientes->createclientes()) {
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Cliente criado com sucesso!'
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Ocorreu um erro ao tentar criar um cliente.'
        );
    }
} else {
    $dados = array(
        'tipo' => 'info',
        'mensagem' => 'Você precisa preencher todos os campos!'
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
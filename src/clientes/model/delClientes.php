<?php
include_once('clientes.php');

$clientes = new Clientes();
$clientes->__set('idcliente', $_REQUEST['idcliente']);

if ($clientes->delClientes()) {
    $dados = array(
        'tipo' => 'success',
        'mensagem' => 'Cliente excluido com sucesso!'
    );
} else {
    $dados = array('tipo' => 'error', 
        'mensagem' => 'Não possível fazer a exclusão do cliente.', 
        'dados' => array()
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
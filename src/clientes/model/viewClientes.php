<?php
include_once('clientes.php');

$clientes = new Clientes();
$clientes->__set('idcliente', $_REQUEST['idcliente']);

if ($clientes->viewClientes()) {
    $result = $clientes->viewClientes();

    $dados = array(
        'tipo' =>'success', 
        'mensagem' => '', 
        'dados' => $result
    );
} else {
    $dados = array('tipo' => 'error', 
        'mensagem' => 'Não possível localizar o cliente.', 
        'dados' => array()
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
<?php
include_once('categorias.php');

$categorias = new Categorias();
$categorias->__set('idcategoria', $_REQUEST['idcategoria']);

if ($categorias->viewCategorias()) {
    $result = $categorias->viewCategorias();

    $dados = array(
        'tipo' =>'success', 
        'mensagem' => '', 
        'dados' => $result
    );
} else {
    $dados = array('tipo' => 'error', 
        'mensagem' => 'Não possível localizar a categoria.', 
        'dados' => array()
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
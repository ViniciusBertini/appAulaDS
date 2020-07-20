<?php
include_once('categorias.php');

$categorias = new Categorias();
$categorias->__set('idcategoria', $_REQUEST['idcategoria']);

if ($categorias->delCategorias()) {
    $dados = array(
        'tipo' => 'success',
        'mensagem' => 'Categoria excluida com sucesso!'
    );
} else {
    $dados = array('tipo' => 'error', 
        'mensagem' => 'Não possível fazer a exclusão da categoria.', 
        'dados' => array()
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
<?php
include_once('categorias.php');

if (!empty($_REQUEST['nome'])) {
    $categorias = new Categorias();
    $categorias->__set('nome', utf8_decode($_REQUEST['nome']));
    if (isset($_REQUEST['ativo'])) {
        $categorias->__set('ativo', 's');
    } else {
        $categorias->__set('ativo', 'n');
    }
    $dataAgora = date('Y/m/d H:i:s', time());
    $categorias->__set('datacriacao', $dataAgora);
    $categorias->__set('datamodificacao', $dataAgora);
    
    if ($categorias->createCategorias()) {
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Categoria criada com sucesso!'
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Ocorreu um erro ao tentar criar a categoria.'
        );
    }
} else {
    $dados = array(
        'tipo' => 'info',
        'mensagem' => 'Você precisa preencher todos os campos'
    );
}

echo json_encode($dados);
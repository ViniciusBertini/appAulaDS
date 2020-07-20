<?php
include_once('categorias.php');

if (!empty($_REQUEST['nome'])) {
    $categorias = new Categorias();
    $categorias->__set('idcategoria', $_REQUEST['idcategoria']);
    $categorias->__set('nome', utf8_decode($_REQUEST['nome']));
    if (isset($_REQUEST['ativo'])) {
        $categorias->__set('ativo', 's');
    } else {
        $categorias->__set('ativo', 'n');
    }
    $dataAgora = date('Y/m/d H:i:s', time());
    $categorias->__set('datamodificacao', $dataAgora);
    
    if ($categorias->updateCategorias()) {
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Categoria alterada com sucesso!'
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Ocorreu um erro ao tentar alterar a categoria.'
        );
    }
} else {
    $dados = array(
        'tipo' => 'info',
        'mensagem' => 'Você não pode deixar campo vazio.'
    );
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
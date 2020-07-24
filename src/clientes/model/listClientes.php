<?php
include('clientes.php');

$clientes = new Clientes();
if ($clientes->listClientes('')) {
    $linhas = $clientes->listClientes('');
    $complemento = '';

    $filtro = $_REQUEST['search']['value'];
    if(!empty($filtro)){
        $complemento .= " AND (idcliente LIKE '$filtro%' ";
        $complemento .= " OR nome LIKE '$filtro%') ";
        $dados = $clientes->listClientes($complemento);
        $totalFiltrados = count($dados);
    } else {
        $totalFiltrados = count($linhas);
    }

    $colunas = $_REQUEST['columns'];
    $colunaOrdem = $_REQUEST['order'][0]['column'];
    $ordem = $colunas[$colunaOrdem]['data'];
    $direcao = $_REQUEST['order'][0]['dir'];

    $inicio = $_REQUEST['start'];
    $tamanho = $_REQUEST['length'];

    $complemento .= " ORDER BY $ordem $direcao LIMIT $inicio, $tamanho";
    $dados = $clientes->listClientes($complemento);

    $json_data = array(
        "draw" => intval($_REQUEST['draw']),
        "recordsTotal" => count($linhas),
        "recordsFiltered" => 5,
        "data" => $dados
    ); 

} else {
    $json_data = array(
        "draw" => 0,
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => array()
    ); 
}

echo json_encode($json_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
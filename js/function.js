$(document).ready(function (){
    $('.categorias').click(function (){
        $('#painel').empty();
        $('#painel').load('src/categorias/view/listCategorias.html');
    })
    $('.clientes').click(function (){
        $('#painel').empty();
        $('#painel').load('src/categorias/view/listCategorias.html');
    })
    $('.produtos').click(function (){
        $('#painel').empty();
        $('#painel').load('src/categorias/view/listCategorias.html');
    })
    $('.formaPagamentos').click(function (){
        $('#painel').empty();
        $('#painel').load('src/categorias/view/listCategorias.html');
    })
})
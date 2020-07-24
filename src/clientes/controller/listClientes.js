$(document).ready(function() {
    $('#tableCliente').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "src/clientes/model/listClientes.php",
            "type": "POST"
        },
        "language": {
            "url": "libs/DataTables/dataTables.brazil.json"
        },
        "columns": [{
                "data": "idcliente",
                "className": "text-center"
            },
            {
                "data": "nome",
                "className": "text-center"
            },
            {
                "data": "datamodificacao",
                "className": "text-center"
            },
            {
                "data": "ativo",
                "orderable": false,
                "serchable": false,
                "className": "text-center",
                "render": function(data, type, row, meta) {
                    return data == 's' ? 'Ativo' : 'Não ativo'
                }
            },
            {
                "data": "idcliente",
                "orderable": false,
                "serchable": false,
                "className": "text-center",
                "render": function(data, type, row, meta) {
                    return `
                    <button id="${data}" class="botao botao-azul botao-pequeno btn-view"><i class="mdi mdi-eye"></i></button>
                    <button id="${data}" class="botao botao-amarelo botao-pequeno btn-edit"><i class="mdi mdi-pencil"></i></button>
                    <button id="${data}" class="botao botao-vermelho botao-pequeno btn-delete"><i class="mdi mdi-trash-can"></i></button>
                    `
                }
            }
        ]
    })
})
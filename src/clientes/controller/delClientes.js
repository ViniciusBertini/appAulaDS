$(document).ready(function() {

    $('#tableCliente').on('click', 'button.btn-delete', function(e) {
        e.preventDefault()

        let idcliente = `idcliente=${$(this).attr('id')}`

        Swal.fire({
            title: 'appAulaDS',
            text: 'Deseja realmente excluir esse cliente?',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    assync: true,
                    data: idcliente,
                    url: 'src/clientes/model/delClientes.php',
                    success: function(dados) {
                        Swal.fire({
                            title: 'appAulaDS',
                            text: dados.mensagem,
                            type: dados.tipo,
                            confirmButtonText: 'OK'
                        })

                        $('#modalCliente').modal('hide')
                        $('#tableCliente').DataTable().ajax.reload()
                    }
                })
            }
        }))
    })
})
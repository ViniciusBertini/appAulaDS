$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()
        $('.modal-title').append('<h3 class="mb-0">Novo Cliente</h3>')

        const datacriacao = new Date().toLocaleString()

        $('.modal-body').load('src/clientes/view/formClientes.html', function() {
            $('#dataagora').val(datacriacao)
        })
        $('.btn-save').show()
        $('.btn-update').hide()
        $('#modalCliente').modal('show')
    })

    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#formCliente').serialize()

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/clientes/model/createClientes.php',
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
    })
})
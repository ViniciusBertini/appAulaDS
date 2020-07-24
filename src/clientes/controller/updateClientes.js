$(document).ready(function() {

    $('#tableCliente').on('click', 'button.btn-edit', function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()
        $('.modal-title').append('<h3 class="mb-0">Edição do cliente</h3>')

        let idcliente = `idcliente=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            assync: true,
            data: idcliente,
            url: 'src/clientes/model/viewClientes.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/clientes/view/formClientes.html', function() {
                        $('#nome').val(dado.dados.nome)
                        $('#email').val(dado.dados.email)
                        $('#telefone').val(dado.dados.telefone)
                        $('#dataagora').val(dado.dados.datacriacao)

                        if (dado.dados.ativo == "n") {
                            $('#ativo').removeAttr('checked')
                        }

                        $('#idcliente').val(dado.dados.idcliente)

                    })
                    $('.btn-save').hide()
                    $('.btn-update').show()
                    $('#modalCliente').modal('show')
                } else {
                    Swal.fire({
                        title: 'appAulaDS',
                        text: dado.mensagem,
                        type: dado.tipo,
                        confirmButtonText: 'OK'
                    })
                }
            }
        })
    })
})

$(document).ready(function() {
    $('.btn-update').click(function(e) {
        e.preventDefault()

        let dados = $('#formCliente').serialize()

        const datamodificacao = new Date().toLocaleString()

        dados += `&datamodificacao=${datamodificacao}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/clientes/model/updateClientes.php',
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
$(document).ready(function() {

    $('#tableCategoria').on('click', 'button.btn-edit', function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()
        $('.modal-title').append('<h3 class="mb-0">Edição de categoria</h3>')

        let idcategoria = `idcategoria=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            assync: true,
            data: idcategoria,
            url: 'src/categorias/model/viewCategorias.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/categorias/view/formCategorias.html', function() {
                        $('#nome').val(dado.dados.nome)
                        $('#dataagora').val(dado.dados.datacriacao)

                        if (dado.dados.ativo == "n") {
                            $('#ativo').removeAttr('checked')
                        }

                        $('#idcategoria').val(dado.dados.idcategoria)

                    })
                    $('.btn-save').hide()
                    $('.btn-update').show()
                    $('#modalCategoria').modal('show')
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

        let dados = $('#formCategoria').serialize()

        const datamodificacao = new Date().toLocaleString()

        dados += `&datamodificacao=${datamodificacao}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/categorias/model/updateCategorias.php',
            success: function(dados) {
                Swal.fire({
                    title: 'appAulaDS',
                    text: dados.mensagem,
                    type: dados.tipo,
                    confirmButtonText: 'OK'
                })

                $('#modalCategoria').modal('hide')
                $('#tableCategoria').DataTable().ajax.reload()
            }
        })
    })
})
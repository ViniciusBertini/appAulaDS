$(document).ready(function() {

    $('#tableCategoria').on('click', 'button.btn-view', function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()
        $('.modal-title').append('<h3 class="mb-0">Visualização de categoria</h3>')

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
                        $('#nome').attr('readonly', 'true')
                        $('#dataagora').val(dado.dados.datacriacao)

                        if (dado.dados.ativo == "n") {
                            $('#ativo').removeAttr('checked')
                        }
                        $('#ativo').attr('readolnly', 'true')
                    })
                    $('.btn-save').hide()
                    $('.btn-update').hide()
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
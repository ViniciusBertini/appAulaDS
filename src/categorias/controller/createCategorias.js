$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()
        $('.modal-title').append('<h3 class="mb-0">Nova categoria</h3>')

        const datacriacao = new Date().toLocaleString()

        $('.modal-body').load('src/categorias/view/formCategorias.html', function() {
            $('#dataagora').val(datacriacao)
        })
        $('.btn-save').show()
        $('#modalCategoria').modal('show')
    })

    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#formCategoria').serialize()

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/categorias/model/createCategorias.php',
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
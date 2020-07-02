$(document).ready(function() {
    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#formCategoria').serialize()

        // $('input[type=checkbox]').each(function() {
        //     if (!this.checked) {
        //         dados += '&' + this.name + '=off'
        //     }
        // })

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
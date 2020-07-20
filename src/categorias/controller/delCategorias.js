$(document).ready(function() {

    $('#tableCategoria').on('click', 'button.btn-delete', function(e) {
        e.preventDefault()

        let idcategoria = `idcategoria=${$(this).attr('id')}`

        Swal.fire({
            title: 'appAulaDS',
            text: 'Deseja realmente excluir essa categoria?',
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
                    data: idcategoria,
                    url: 'src/categorias/model/delCategorias.php',
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
            }
        }))
    })
})
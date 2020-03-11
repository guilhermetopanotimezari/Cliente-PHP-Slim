(function(){
    'use strict';

    var API_URL = 'http://' + location.host + '/'+ site +'/server/usuario/',
        $table = $('#table-usuarios').bootstrapTable({
            url: API_URL,
            contentType: 'application/json;charset=utf-8'
        }),
        $modal = $('#modal-usuarios').modal({ show: false }),
        $alert = $('.alert').hide(),
        $danger = $('.alert-danger').hide();


    $('.side-nav .usuarios').addClass('active');

    $('.create-usuario').click(function () {
        showModal($(this).text());
    });

    $('#table-usuarios').on('dbl-click-row.bs.table', function(e, row, $element) {
        showModal('Visualizar usuário', row);
    });

    $modal.find('.submit').click(function () {
        var row = {};

        $modal.find('input[name],select[name]').each(function () {
            row[$(this).attr('name')] = $(this).val();
        });

        if(!row['nome'] || !row['usuario'] || !row['senha'] ){
            $('[data-toggle="validator"]').validator('validate');
            return false;
        }

        $.ajax({
            url: API_URL + ($modal.data('id') || ''),
            type: $modal.data('id') ? 'put' : 'post',
            contentType: 'application/json;charset=utf-8',
            data: JSON.stringify(row),
            success: function () {
                $modal.modal('hide');
                $table.bootstrapTable('refresh');
                showAlert('Registro ' + ($modal.data('id') ? 'alterado' : 'inserido') + ' com sucesso!', 'success');
            },
            error: function (response) {
                showDanger(response.responseJSON.message);
            }
        });
    });

    // update and delete events
    window.actionEvents = {
        'click .update': function (e, value, row) {
            showModal($(this).attr('title'), row);
        },
        'click .remove': function (e, value, row) {
            if (confirm('Você tem certeza que deseja remover este item?')) {
                $.ajax({
                    url: API_URL + row.id,
                    type: 'delete',
                    success: function () {
                        $table.bootstrapTable('refresh');
                        showAlert('Removido item com sucesso!', 'success');
                    },
                    error: function () {
                        showAlert('Erro ao tentar remover o item!', 'danger');
                    }
                })
            }
        }
    };

    function showModal(title, row) {
        row = row || {
            id: '',
            nome: '',
            usuario: '',
            senha: ''
        };

        $('[data-toggle="validator"]').validator('destroy');
        $danger.hide();

        $modal.data('id', row.id);
        $modal.find('.modal-title').text(title);
        for (var name in row) {
            $modal.find('input[name="' + name + '"],select[name="' + name + '"]').val(row[name]);
        }
        $modal.modal('show');
    }

    function showAlert(title, type) {
        $alert.attr('class', 'alert alert-' + type || 'success')
              .html('<i class="glyphicon glyphicon-check"></i> ' + title).show();
        setTimeout(function () {
            $alert.hide();
        }, 3000);
    }

    function showDanger(erro){
        $modal.find('.alert-danger').text(erro);
        $danger.show();
    }
})();
(function(){
	'use strict';

    var sucessoHoje = location.search.split('sucessoHoje=')[1],
        erroHoje = location.search.split('erroHoje=')[1],
        falta = location.search.split('falta=')[1],
        erro = location.search.split('erro=')[1],
        sucesso = location.search.split('sucesso=')[1],
        API_URL = 'http://' + location.host + '/'+ site +'/server/cliente/?sucessoHoje='+sucessoHoje+'&erroHoje='+erroHoje+'&falta='+falta+'&erro='+erro+'&sucesso='+sucesso,
        API_URL_VERSAO = 'http://' + location.host + '/'+ site +'/server/versao/',
        API_URL_LIBMANUAL = 'http://' + location.host + '/'+ site +'/server/libmanual/',
        $table = $('#table-cliente').bootstrapTable({
    		url: API_URL
    	}),
        $modal = $('#modal-cliente').modal({ show: false }),
        $modalVersao = $('#modal-versaomanual').modal({ show: false }),
        $alert = $('.alert').hide(),
        $danger = $('.alert-danger').hide();


    $('.side-nav .clientes').addClass('active');

   
    $('.create-cliente').click(function () {
        showModal($(this).text());
    });

    $('#table-cliente').on('dbl-click-row.bs.table', function(e, row, $element) {
        showModal('Editar cliente', row);
    });

    $modal.find('.submit').click(function () {
        var row = {};

        $modal.find('input[name],select[name]').each(function () {
            row[$(this).attr('name')] = $(this).val();
        });

        if(!row['nome'] || !row['cnpj'] || !row['codigoInterno']){
            $('[data-toggle="validator"]').validator('validate');
            return false;
        }

        $.ajax({
            url: API_URL + ($modal.data('id') || ''),
            type: $modal.data('id') ? 'put' : 'post',
            contentType: 'application/json',
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
            if (confirm('Você tem certeza que deseja remover este registro?')) {
                $.ajax({
                    url: API_URL + row.id,
                    type: 'delete',
                    contentType: 'application/json',
                    success: function () {
                        $table.bootstrapTable('refresh');
                        showAlert('Removido item com sucesso!', 'success');
                    },
                    error: function (response) {
                        alert(response.responseJSON.message);
                    }
                });
            }
        }
    };

    window.actionEventsButtons = {
        'click .liberar': function (e, value, row) {
            fnBloquearLiberar(row, 'liberar');
        },
        'click .bloquear': function (e, value, row) {
            fnBloquearLiberar(row, 'bloquear');
        },
        'click .versaomanual': function (e, value, row) {
            showModalVersaoManual(row);
        },
        'click .selecionarversao': function (e, value, row) {
            fnAdicionaVersaoManual(row);
        }
    };

    function fnAdicionaVersaoManual(row) {
        var dto = {
            id: "",
            idVersao: row.id, 
            idCliente: $modalVersao.find('input[name="codigocliente"]').val()
        };

        $.ajax({
            url: API_URL_LIBMANUAL,
            type: 'post',
            contentType: 'application/json',
            data: JSON.stringify(dto),
            success: function () {
                $table.bootstrapTable('refresh');
                $modalVersao.modal('hide');
                showAlert('Versão vinculada com sucesso!', 'success');
            },
            error: function () {
                $modalVersao.modal('hide');
                showAlert('Não foi possível vincular esta versão!', 'danger');
            }
        }); 
    }

    function fnBloquearLiberar(row, tipo) {
        var oldValue = row['bloqueado'];

        row['bloqueado'] = tipo == 'liberar' ? 0 : 1;

        $.ajax({
            url: API_URL + row['id'],
            type: 'put',
            contentType: 'application/json',
            data: JSON.stringify(row),
            success: function () {
                $table.bootstrapTable('refresh');
                showAlert('Registro alterado com sucesso!', 'success');
            },
            error: function () {
                showAlert('Não foi possível alterar o registro!', 'danger');
                row['bloqueado'] = oldValue;
            }
        }); 
    }

    function showModalVersaoManual(row) {
        $('#table-versaomanual').bootstrapTable({
            url: API_URL_VERSAO
        });
        
        $modalVersao.find('input[name="codigocliente"]').val(row.id);

        $modalVersao.modal('show');
    }

    function showModal(title, row) {
        row = row || {
            id: '',
            nome: '',
            cnpj: '',
            idVersao: '1',
            quantDias: '10',
            quantMinSinc: '60',
            bloqueado: '0',
            obs: ''
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
(function(){
    'use strict';

    var API_URL = 'http://' + location.host + '/'+ site +'/server/home/';

    $.ajax({
        url: API_URL,
        type: 'get',
        contentType: 'application/json',
        data: '',
        success: function (data) {
        	var $quantSucessoHoje = document.getElementById('quantSucessoHoje'),
        		$quantErroHoje = document.getElementById('quantErroHoje'),
        		$quantFaltaHoje = document.getElementById('quantFaltaHoje'),
        		$quantSucesso = document.getElementById('quantSucesso'),
        		$quantErro = document.getElementById('quantErro'),
        		$quantFalta = document.getElementById('quantFalta'),
        		$nomeVersaoHoje = document.getElementById('nomeVersaoHoje'),
        		$nomeVersaoTotal = document.getElementById('nomeVersaoTotal');

            if(!data || !data.length){
            	return;
            }
            $quantSucessoHoje.innerText = data[0].quantSucessoHoje;
			$quantErroHoje.innerText = data[0].quantErroHoje;
			$quantFaltaHoje.innerText = data[0].quantFaltaHoje;
			$quantSucesso.innerText = data[0].quantSucesso;
			$quantErro.innerText = data[0].quantErro;
			$quantFalta.innerText = data[0].quantFalta;
			$nomeVersaoHoje.innerText = 'Hoje Versão: ' + data[0].nomeVersao + ' - '+data[0].dataDispVersao.substr(8,2)+'/'+data[0].dataDispVersao.substr(5,2)+'/'+data[0].dataDispVersao.substr(0,4);
			$nomeVersaoTotal.innerText = 'Total Versão: ' + data[0].nomeVersao + ' - '+data[0].dataDispVersao.substr(8,2)+'/'+data[0].dataDispVersao.substr(5,2)+'/'+data[0].dataDispVersao.substr(0,4);

        },
        error: function (response) {
            showDanger(response.responseJSON.message);
        }
    });
   

})();
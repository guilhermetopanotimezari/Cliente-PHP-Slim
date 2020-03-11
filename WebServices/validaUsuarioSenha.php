<?php
    function validaUsuarioSenha($usuario, $senha){
    	if($usuario != 'abc' || $senha != "1"){
    		throw new Exception('Usuário/Senha inválido');
    	}
    	
    }
?>
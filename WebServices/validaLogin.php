<?php
    function validaLogin($usuario, $senha, $usuarioSistema, $senhaSistema){
        validaUsuarioSenha($usuario, $senha);


        $sql="";
        $sql=$sql." SELECT * ";
        $sql=$sql." FROM USUARIO  ";
        $sql=$sql." WHERE USUARIO=:usuarioSistema AND SENHA=:senhaSistema  ";
        $sql=$sql." ORDER BY ID ASC ";
        
        $conn = getConn();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("usuarioSistema", $usuarioSistema);
        $stmt->bindParam("senhaSistema", $senhaSistema);
        $stmt->execute();
        $listaUsuarios = $stmt->fetchAll(PDO::FETCH_OBJ);


        $usuarioSenhaExiste = 0;
        if(count($listaUsuarios) >0){
            $usuarioSenhaExiste = 1;
        }

        return $usuarioSenhaExiste;
    }

?>
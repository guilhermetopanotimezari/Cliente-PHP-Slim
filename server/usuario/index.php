<?php
    include("../utilSlim.php");

    function getTabela(){
        return 'USUARIO';
    }

    function getSql(){
        return ' '.
            'SELECT * '.
            'FROM '.getTabela().' '.
            ' WHERE 1 = 1 '.
            getOrderBy();
    }    

    function getOrderBy() {
        return 'ORDER BY ID ';
    }        

    function getCampos(){
        return array(
            array('ID','id'),
            array('NOME','nome'),
            array('USUARIO','usuario'), 
            array('SENHA','senha'), 
        );
    }

    function persistir(){
        $request = \Slim\Slim::getInstance()->request();
        $usuario = json_decode($request->getBody());
        if(($usuario->id)> 0){
            update($usuario);
        } else {
            insert($usuario);
        }
    }

    function insert($usuario){
        try {        
            $sql = 'insert into USUARIO (NOME, USUARIO, SENHA) values ( :nome, :usuario, :senha )';
            $conn = getConn();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("nome",$usuario->nome);
            $stmt->bindParam("usuario",$usuario->usuario);
            $stmt->bindParam("senha",$usuario->senha);
            $stmt->execute();

            $usuario->id = $conn->lastInsertId();
            echo json_encode($usuario);
        } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $e->getMessage(), 'error' => 1)));
        }
        
    }

    function update($usuario){
        try {
            $sql = 'update USUARIO set NOME = :nome,USUARIO = :usuario,SENHA = :senha WHERE ID = :id';

            $conn = getConn();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("id",$usuario->id);
            $stmt->bindParam("nome",$usuario->nome);
            $stmt->bindParam("usuario",$usuario->usuario);
            $stmt->bindParam("senha",$usuario->senha);
            $stmt->execute();
            echo json_encode($usuario);
        } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $e->getMessage(), 'error' => 1)));
        }        
    }

?>
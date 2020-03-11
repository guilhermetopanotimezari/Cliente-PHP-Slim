<?php
    include("../utilSlim.php");

    function getTabela(){
        return 'CLIENTE';
    }

    function getSql(){
        $sql = ' '.
            'SELECT CLIENTE.*'.
            'FROM CLIENTE '.
            ' WHERE 1 = 1 ';


        $sql = $sql.getOrderBy();

        return $sql;
    }    

    function getOrderBy() {
        return 'ORDER BY ID ';
    }    

    function getCampos(){
        return array(
            array('ID','id'),
            array('IDVERSAO','idVersao'),
            array('NOME','nome'),
            array('CODIGOINTERNO','codigoInterno'),
            array('QUANTINSTALACOES','quantInstalacoes'),
            array('QUANTDIAS','quantDias'),
            array('CNPJ','cnpj'),
            array('BLOQUEADO','bloqueado'),
            array('OBS','obs'),
            array('QUANTMINSINC','quantMinSinc'),
            array('NOMEVERSAO','nomeVersao'),
        );
    }

    function persistir(){
        $request = \Slim\Slim::getInstance()->request();
        $cliente = json_decode($request->getBody());
        if(($cliente->id)>0){
            update($cliente);
        } else {
            insert($cliente);
        }
    }

    function insert($cliente){
        try {
            $sql = 'insert into CLIENTE (IDVERSAO, NOME, CODIGOINTERNO, QUANTINSTALACOES, QUANTDIAS, CNPJ, BLOQUEADO, OBS, QUANTMINSINC) values ( :idVersao, :nome, :codigoInterno, :quantInstalacoes, :quantDias, :cnpj, :bloqueado, :obs, :quantMinSinc )';
            $conn = getConn();

            $cliente->bloqueado = 0;
            $cliente->idVersao = 1;
            $cliente->quantMinSinc = 60;
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("idVersao",$cliente->idVersao);
            $stmt->bindParam("nome",$cliente->nome);
            $stmt->bindParam("codigoInterno",$cliente->codigoInterno);
            $stmt->bindParam("quantInstalacoes",$cliente->quantInstalacoes);
            $stmt->bindParam("quantDias",$cliente->quantDias);
            $stmt->bindParam("cnpj",$cliente->cnpj);
            $stmt->bindParam("bloqueado",$cliente->bloqueado);
            $stmt->bindParam("obs",$cliente->obs);
            $stmt->bindParam("quantMinSinc",$cliente->quantMinSinc);
            $stmt->execute();

            $cliente->id = $conn->lastInsertId();
            echo json_encode($cliente);
        } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $e->getMessage(), 'error' => 1)));
        }      
    }

    function update($cliente){
        try {      
            $sql = 'update CLIENTE set NOME = :nome, CODIGOINTERNO = :codigoInterno, QUANTDIAS = :quantDias, CNPJ = :cnpj, BLOQUEADO = :bloqueado, OBS = :obs where ID = :id';
            $conn = getConn();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("id",$cliente->id);
            //$stmt->bindParam("idVersao",$cliente->idVersao);
            $stmt->bindParam("nome",$cliente->nome);
            $stmt->bindParam("codigoInterno",$cliente->codigoInterno);
            $stmt->bindParam("quantDias",$cliente->quantDias);
            $stmt->bindParam("cnpj",$cliente->cnpj);
            $stmt->bindParam("bloqueado",$cliente->bloqueado);
            $stmt->bindParam("obs",$cliente->obs);
            //$stmt->bindParam("quantMinSinc",$cliente->quantMinSinc);
            $stmt->execute();
            echo json_encode($cliente);
        } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $e->getMessage(), 'error' => 1)));
        }        
    }

?>
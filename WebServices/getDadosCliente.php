<?php

    function getDadosClientePorId($usuario, $senha, $idCliente){
        $sql="";
        $sql=$sql." SELECT * ";
        $sql=$sql." FROM CLIENTE  ";
        $sql=$sql." WHERE ID=:id  ";
        $sql=$sql." ORDER BY ID DESC ";
        
        $conn = getConn();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id", $idCliente);
        $stmt->execute();
        $retorno = $stmt->fetchAll(PDO::FETCH_OBJ);
                
        $clienteObject = new stdClass();
        $clienteObject->id=0;
        $clienteObject->idVersao=0;
        $clienteObject->nome="";
        $clienteObject->codigoInterno="";
        $clienteObject->quantInstalacoes=0;
        $clienteObject->quantDias=0;
        $clienteObject->cnpj="";
        $clienteObject->bloqueado=0;
        $clienteObject->obs="";
        $clienteObject->quantMinSinc=0;

        if(count($retorno)>0){
            $clienteObject = new stdClass();
            $primeiro = current($retorno);
            $clienteObject->id=$primeiro->ID;
            $clienteObject->idVersao=$primeiro->IDVERSAO;
            $clienteObject->nome=$primeiro->NOME;
            $clienteObject->codigoInterno=$primeiro->CODIGOINTERNO;
            //$clienteObject->quantInstalacoes=$primeiro->QUANTINSTALACOES;
            $clienteObject->quantDias=$primeiro->QUANTDIAS;
            $clienteObject->cnpj=$primeiro->CNPJ;
            $clienteObject->bloqueado=$primeiro->BLOQUEADO;
            $clienteObject->obs=$primeiro->OBS;
            $clienteObject->quantMinSinc=$primeiro->QUANTMINSINC;
        }        
        return $clienteObject;
    }

    function getDadosClientePorCodigoInterno($usuario, $senha, $codigoInterno){
        $sql="";
        $sql=$sql." SELECT * ";
        $sql=$sql." FROM CLIENTE  ";
        $sql=$sql." WHERE CODIGOINTERNO=:codigoInterno  ";
        $sql=$sql." ORDER BY ID DESC ";
        
        $conn = getConn();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("codigoInterno", $codigoInterno);
        $stmt->execute();
        $retorno = $stmt->fetchAll(PDO::FETCH_OBJ);
                
        $clienteObject = new stdClass();
        $clienteObject->id=0;
        $clienteObject->idVersao=0;
        $clienteObject->nome="";
        $clienteObject->codigoInterno="";
        $clienteObject->quantInstalacoes=0;
        $clienteObject->quantDias=0;
        $clienteObject->cnpj="";
        $clienteObject->bloqueado=0;
        $clienteObject->obs="";
        $clienteObject->quantMinSinc=0;

        if(count($retorno)>0){
            $clienteObject = new stdClass();
            $primeiro = current($retorno);
            $clienteObject->id=$primeiro->ID;
            $clienteObject->idVersao=$primeiro->IDVERSAO;
            $clienteObject->nome=$primeiro->NOME;
            $clienteObject->codigoInterno=$primeiro->CODIGOINTERNO;
            //$clienteObject->quantInstalacoes=$primeiro->QUANTINSTALACOES;
            $clienteObject->quantDias=$primeiro->QUANTDIAS;
            $clienteObject->cnpj=$primeiro->CNPJ;
            $clienteObject->bloqueado=$primeiro->BLOQUEADO;
            $clienteObject->obs=$primeiro->OBS;
            $clienteObject->quantMinSinc=$primeiro->QUANTMINSINC;
        }        
        return $clienteObject;
    }
    


?>

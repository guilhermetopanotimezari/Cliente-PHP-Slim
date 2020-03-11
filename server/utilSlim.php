<?php
    require '../../Slim-2.6.2/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();
    $app = new \Slim\Slim();
    $app->response()->header('Content-Type', 'application/json;charset=utf-8');

    include("../conexao.php");
    include("../util.php");

    $app->get('/','get');
    $app->get('/:id','getById');
    $app->delete('/:id','delete');
    $app->post('/','persistir');
    $app->post('/:id','persistir');
    $app->put('/:id','persistir');
    $app->run();

    function getCampoId(){
        return 'ID';
    }

    function getFiltersWhere(){
        $filtros = "";
        foreach ($_GET as $key => $value) {
            if(getBdName($key)){
                $filtros = $filtros." AND ".getBdName($key)." = ".$value;
            }        
        } 
        return $filtros;
    }

    function get(){
        try {
            $sql = getSql();
            // $filtersWhere = getFiltersWhere();
            // $sql = $sql.$filtersWhere;
            //echo $sql;
            $stmt = getConn()->query($sql);

            $retorno = $stmt->fetchAll(PDO::FETCH_OBJ);
            $retorno = getJsonFieldNames($retorno);

            echo json_encode($retorno);
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    function getJsonFieldNames($arrayFields){
        $fields = getCampos();
        $newArray = [];

        foreach($arrayFields as $obj){
            $newObj = new stdClass();
            foreach($obj as $prop => $value){
                $newProp = getJsonName($prop);
                $newObj->$newProp=$value;
            }
            array_push($newArray, $newObj);
        }

        return $newArray;
    }

    function getJsonName($bdName){
        $fields = getCampos();
        $key = array_search($bdName, array_column($fields, 0));
        return $fields[$key][1];
    }

    function getBdName($jsonName){
        $fields = getCampos();
        $key = array_search($jsonName, array_column($fields, 1));
        return $fields[$key][0];
    }

    function getById($id){
        $conn = getConn();
        $sql = getSql().'WHERE '.getCampoId().' = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        $retorno[] = $stmt->fetchObject();

        echo json_encode($retorno);
    }

    function delete($id){
        try {
            $sql = 'DELETE FROM '.getTabela().' WHERE '.getCampoId().'=:id';
            $conn = getConn();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam("id",$id);
            $stmt->execute();
            echo json_encode($id);
        
        } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $e->getMessage(), 'error' => 1)));
        }
       
    }

?>
<?php
        
    require '../../Slim-2.6.2/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();
    $app = new \Slim\Slim();
    $app->response()->header('Content-Type', 'application/json;charset=utf-8');
    include("../conexao.php");
    include("../util.php");
    
    $app->post('/','login');


    function login($usuario){
        $request = \Slim\Slim::getInstance()->request();
        $usuario = json_decode($request->getBody());

        $usuario = $usuario->usuario;
        $senha =  $usuario->senha;
        echo $usuario;
        $sql='SELECT * from USUARIO where USUARIO="'.$usuario.'" and SENHA="'.$senha.'"';
        $conn = getConn();
        $stmt = $conn->prepare($sql);

        $arr = $stmt->fetch_array(MYSQLI_ASSOC);
        if($arr == null){
            echo json_encode(array(
                "error" => 1,
                "message" => "Usuário ou senha não existe",
            ));
            return;
        }
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('Location: ../../home');

        echo json_encode(array(
            "error" => 0,
            "message" => "Usuário logado com sucesso",
            "usuario" => $arr
        )); 
    }
?>
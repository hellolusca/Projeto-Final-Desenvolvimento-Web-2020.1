<?php
// HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexão com a base de dados
require '../../config/database.php';
$db_connection = new Database();
$conn = $db_connection->Connection();

// Dados da requisição
$data = json_decode(file_get_contents("php://input"));
$msg['message'] = '';


if(isset($data->username) && isset($data->password) && isset($data->type)){
    if(!empty($data->username) && !empty($data->password) && !empty($data->type)){
        
        $insert_query = "INSERT INTO `login`(`username`,`password`,`type`) VALUES(:username,:password,:type)";
        $insert_stmt = $conn->prepare($insert_query);

        $insert_stmt->bindValue(':username', htmlspecialchars(strip_tags($data->username)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':password', htmlspecialchars(strip_tags($data->password)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':type', htmlspecialchars(strip_tags($data->type)),PDO::PARAM_STR);
        
        if($insert_stmt->execute()){
            $msg['message'] = 'Dados inseridos com sucesso!';
        }else{
            $msg['message'] = 'Dados não inseridos';
        } 
        
    }else{
        $msg['message'] = 'Opa! Campos vazios detectados. Por favor preencha todos os campos';
    }
}
else{
    $msg['message'] = 'Por favor preencha todos os campos | Usuário, Senha';
}
echo  json_encode($msg);
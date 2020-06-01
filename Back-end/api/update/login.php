<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexão com a base de dados
require '../../config/database.php';
$db_connection = new Database();
$conn = $db_connection->Connection();

// Dados da requisição
$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)){
    $msg['message'] = '';
    $id = $data->id;
    
    $sql = "SELECT * FROM `login` WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $update_query = "UPDATE `login` SET name = '$data->name', surname = '$data->surname', username = '$data->username', password = '$data->password' 
        WHERE id = '$data->id'";
        
        $update_stmt = $conn->prepare($update_query);      
        
        if($update_stmt->execute()){
            $msg['message'] = 'Data updated successfully';
        }else{
            $msg['message'] = 'data not updated';
        }   
        
    }
    else{
        $msg['message'] = 'Invlid ID';
    }
    
    
} else {
    $msg['message'] = 'Cannot POST';
}

echo  json_encode($msg);
?>
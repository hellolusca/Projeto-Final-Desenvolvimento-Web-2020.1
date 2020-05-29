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
    
    $data = json_decode(file_get_contents("php://input"));
    $user = $data->username;
    $pass = $data->password;
    

    if (isset($user) && isset($pass)) {
        $query = "SELECT * FROM `login` WHERE username ='$user' AND password = '$pass'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $msg = [
                    'id'=>$row['id'],
                    'username'=>$row['username'],
                    'name'=>$row['name'],
                    'surname'=>$row['surname'],
                    'type'=>$row['type']
                ];
            }
        } else {
            $msg = [
                'error'=>'Usuário ou senha incorretos.'
            ];
        }

        
    }
    else {
        $msg['message'] = 'Campo(s) vazio(s)';
    }

    echo json_encode($msg);
?>
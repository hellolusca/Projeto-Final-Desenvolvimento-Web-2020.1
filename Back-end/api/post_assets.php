<?php
include __DIR__.'/../control/assetsControl.php';
 
header('Content-type: application/json');

$data = file_get_contents('php://input');
$obj =  json_decode($data);

if(empty($data)){
	http_response_code(400);
	echo json_encode(array("mensagem" => "Não foram enviados parâmetros"));
}
else {
	if ($obj->oper == "update") {
		try {
			$assetsControl = new AssetsControl();
			$resposta = $assetsControl->update($obj);
			http_response_code(200);
			$res[] = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => "Parâmetros Inválidos"));
	   }
	} 
	if ($obj->oper == "insert") {
		try {
			$assetsControl = new AssetsControl();
			$resposta = $assetsControl->insert($obj);
			http_response_code(200);
			$res[] = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => $e));
	   	}
	}
	if ($obj->oper == "count") {
		try {
			$assetsControl = new AssetsControl();
			$resposta = $assetsControl->count();
			http_response_code(200);
			$res = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => $e));
	   	}
	}
}
?>
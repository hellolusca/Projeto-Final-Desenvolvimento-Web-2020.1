<?php
include __DIR__.'/../control/ProvidersControl.php';
 
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
			$providersControl = new ProvidersControl();
			$resposta = $providersControl->update($obj);
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
			$providersControl = new ProvidersControl();
			$resposta = $providersControl->insert($obj);
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
			$providersControl = new ProvidersControl();
			$resposta = $providersControl->count();
			http_response_code(200);
			$res = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => $e));
	   	}
	}
	if ($obj->oper == "filter") {
		try {
			$providersControl = new ProvidersControl();
			$resposta = $providersControl->filter($obj);
			http_response_code(200);
			$res = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => $e));
	   	}
	}

	if ($obj->oper == "delete") {
		try {
			$providersControl = new ProvidersControl();
			$resposta = $providersControl->delete($obj->id);
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
<?php
include __DIR__.'/../control/EmployeesControl.php';
 
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
			$employeesControl = new EmployeesControl();
			$resposta = $employeesControl->update($obj);
			http_response_code(200);
			$res[] = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => $e));
	   }
	} 
	if ($obj->oper == "insert") {
		try {
			$employeesControl = new EmployeesControl();
			$resposta = $employeesControl->insert($obj);
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
			$employeesControl = new EmployeesControl();
			$resposta = $employeesControl->count();
			http_response_code(200);
			$res = $resposta;
			echo json_encode($res);
		}
		catch (PDOException $e) {
			http_response_code(400);
		   echo json_encode(array("mensagem" => $e));
	   	}
	}
	if ($obj->oper == "jobs") {
		try {
			$employeesControl = new EmployeesControl();
			$resposta = $employeesControl->jobs();
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
			$employeesControl = new EmployeesControl();
			$resposta = $employeesControl->filter($obj);
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
			$employeesControl = new EmployeesControl();
			$resposta = $employeesControl->delete($obj->id);
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
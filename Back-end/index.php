<?php

header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: GET, POST,");

//define('PASTAPROJETO', 'AulaBanco');
define('PASTAPROJETO', 'Back-end');

/* Função criada para retornar o tipo de requisição */
function checkRequest() {
	$method = $_SERVER['REQUEST_METHOD'];
	switch ($method) {
	  case 'PUT':
	  	$answer = "update";
	    break;
	  case 'POST':	  
	  	$answer = "post";
	    break;
	  case 'GET':
	  	$answer = "get";
	    break;
	  case 'DELETE':
	  	$answer = "delete";
	    break;
	}
	return $answer;
}

$answer = checkRequest();

$request = $_SERVER['REQUEST_URI']; 

// IDENTIFICA A URI DA REQUISIÇÃO

$args = explode('/', rtrim($request, '/'));
// localhost/PhpBackEnd/pessoas
// $args[0] localhost
// $args[1] PhpBackEnd
// $args[2] pessoas

$endpoint = array_shift($args);
if (array_key_exists(0, $args) && !is_numeric($args[0])) {
    $verb = array_shift($args);
}

if ($args) {
	$request = '/'.PASTAPROJETO.'/'.$args[0];
	// /PhpBackEnd/pessoas
	// /PhpBackEnd/pessoas/1
	// /PhpBackEnd/conteudo
}

switch ($request) {
	case '/'.PASTAPROJETO:	
      require __DIR__ . '/api/api.php';
        break;
	case '/'.PASTAPROJETO.'/' :		
        require __DIR__ . '/api/api.php';
        break;
    case '' :
        require __DIR__ . '/api/api.php';
        break;
	case '/'.PASTAPROJETO.'/login' :		
		require __DIR__ . '/api/'.$answer.'_login.php';
		break;
	case '/'.PASTAPROJETO.'/employees' :		
		require __DIR__ . '/api/'.$answer.'_employees.php';
		break;
	case '/'.PASTAPROJETO.'/providers' :		
		require __DIR__ . '/api/'.$answer.'_providers.php';
		break;
	case '/'.PASTAPROJETO.'/products' :		
		require __DIR__ . '/api/'.$answer.'_products.php';
		break;
	case '/'.PASTAPROJETO.'/assets' :		
		require __DIR__ . '/api/'.$answer.'_assets.php';
		break;
    default:
        require __DIR__ . '/api/404.php';
		break;		
}
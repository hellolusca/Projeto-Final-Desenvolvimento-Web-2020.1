<?php
include __DIR__.'/../model/Login.php';

class LoginControl{
	function insert($obj){		
		$login = new Login();	
		$password = crypt($obj->password, "");
		$obj->password = $password;		
		return $login->insert($obj);		
	}

	function update($obj){
		$login = new Login();
		$password = crypt($obj->password, "");
		$obj->password = $password;	
		return $login->update($obj);
	}

	function delete($obj,$id){
		$login = new Login();
		return $login->delete($obj,$id);
	}

	function find($id = null){
		$login = new Login();
		return $login->find($id);
	}

	function findAll(){
		$login = new Login();
		return $login->findAll();
	}

	function logon($obj) {
		$login = new Login();
		$res = $login->logon($obj);
		if ($res->check == "ok") {
			if (crypt($obj->password, $res->password) == $res->password) {
				$res->status = true;
				unset($res->password);
			} else {
				unset($res->id);
				unset($res->name);
				unset($res->surname);
				unset($res->username);
				unset($res->password);
				unset($res->type);
				$res->status = false;
			}
		}
		return $res;
	}
}

?>
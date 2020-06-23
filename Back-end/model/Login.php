<?php
error_reporting(0);
include __DIR__.'/Conexao.php';

class Login extends Conexao {
    private $id; 
	private $name;
    private $surname;    
    private $username;
    private $password;
    private $type;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    
    
    public function insert($obj){
    	$sql = "INSERT INTO login (name,surname,username,password,type) VALUES (:name,:surname,:username,:password,:type)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('name',  $obj->name);
        $consulta->bindValue('surname' , $obj->surname);
        $consulta->bindValue('username' , $obj->username);
        $consulta->bindValue('password', $obj->password);
        $consulta->bindValue('type' , $obj->type);
        $consulta->execute();
        $last = $this->find(Conexao::lastId());
        $last->status = "true";
        $last->msg = "Successfully inserted";
        return $last;
	}

	public function update($obj){
		$sql = "UPDATE login SET 
            name = :name, 
            surname = :surname,
            username = :username, 
            password = :password,
            type = :type 
        WHERE id = :id ";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('name', $obj->name);
		$consulta->bindValue('surname' , $obj->surname);		
        $consulta->bindValue('username' , $obj->username);
        $consulta->bindValue('password', $obj->password);
        $consulta->bindValue('type', $obj->type);
		$consulta->bindValue('id', $obj->id);
        $consulta->execute();
        $last = $this->find($obj->id);
        $last->status = "true";
        $last->msg = "Successfully updated";
        return $last;
	}

	public function delete($obj,$id = null){
		$sql =  "DELETE FROM login WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
        return $consulta->execute();
	}

	public function find($id = null){
        $sql =  "SELECT name,surname,username,type FROM login WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id',$id);
        $consulta->execute();
        return $consulta->fetch();
	}

	public function findAll(){
		$sql = "SELECT name,surname,username,type FROM login";
		$consulta = Conexao::prepare($sql);
		$consulta->execute();
		return $consulta->fetchAll();
    }

    public function logon($obj){
        $res = new \stdClass();
        $sql =  "SELECT * FROM login WHERE username = :username";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('username',$obj->username);
        $consulta->execute();
        $res = $consulta->fetch();
        if (isset($res->id)) {
            $res->check = "ok";
        } else {
            $res->check = "notok";
        }
        return $res;        
	}
}
?>
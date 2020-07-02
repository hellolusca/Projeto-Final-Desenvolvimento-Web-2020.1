<?php
//error_reporting(0);
include __DIR__.'/Conexao.php';

class Employees extends Conexao {
    private $id; 
	private $name;
    private $surname;
    private $age;
    private $email;
    private $cellphone;
    private $cpf;
    private $salary;
    private $job_title_id;

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

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getCellphone() {
        return $this->cellphone;
    }

    public function setCellphone($cellphone) {
        $this->cellphone = $cellphone;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getJobTitleId() {
        return $this->job_title_id;
    }

    public function setJobTitleId($job_title_id) {
        $this->job_title_id = $job_title_id;
    }
    
    public function insert($obj){
    	$sql = "INSERT INTO employees (name,surname,age,email,cellphone,cpf,salary,job_title_id) VALUES (:name,:surname,:age,:email,:cellphone,:cpf,:salary,:job_title_id)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('name',  $obj->name);
        $consulta->bindValue('surname' , $obj->surname);
        $consulta->bindValue('age' , $obj->age);
        $consulta->bindValue('email', $obj->email);
        $consulta->bindValue('cellphone' , $obj->cellphone);
        $consulta->bindValue('cpf', $obj->cpf);
        $consulta->bindValue('salary' , $obj->salary);
        $consulta->bindValue('job_title_id' , $obj->job_title_id);
        $consulta->execute();
        $last = $this->find(Conexao::lastId());
        $last->status = "true";
        $last->msg = "Successfully inserted";
        return $last;        
    }

	public function update($obj){
		$sql = "UPDATE employees SET 
            name = :name, 
            surname = :surname,
            age = :age, 
            email = :email,
            cellphone = :cellphone,
            cpf = :cpf,
            salary = :salary,
            job_title_id = :job_title_id
        WHERE id = :id ";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('name',  $obj->name);
        $consulta->bindValue('surname' , $obj->surname);
        $consulta->bindValue('age' , $obj->age);
        $consulta->bindValue('email', $obj->email);
        $consulta->bindValue('cellphone' , $obj->cellphone);
        $consulta->bindValue('cpf', $obj->cpf);
        $consulta->bindValue('salary' , $obj->salary);
        $consulta->bindValue('job_title_id' , $obj->job_title_id);
        $consulta->bindValue('id' , $obj->id);
        $consulta->execute();
        $last = $this->find($obj->id);
        $last->status = "true";
        $last->msg = "Successfully updated";
        return $last;
	}

	public function delete($id = null){
		$sql = "DELETE FROM employees WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
        return $consulta->execute();
	}

	public function find($id = null){
        $sql =  "SELECT * FROM employees WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id',$id);
        $consulta->execute();
        return $consulta->fetch();
	}

	public function findAll(){
		$sql = "SELECT * FROM employees ORDER BY `id` asc";
		$consulta = Conexao::prepare($sql);
		$consulta->execute();
		return $consulta->fetchAll();
    }

    public function count(){
        $sql =  "SELECT * FROM employees";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        $res = $consulta->rowCount();
        return $res;       
    }
    
    public function jobs(){
        $sql =  "SELECT * FROM job_titles ORDER BY name ASC";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();;       
    }
    
    public function filter($obj){
        $sql =  "SELECT id,name,surname,cpf,email,cellphone FROM employees WHERE ".$obj->filter_by." LIKE '".$obj->keyword."%' ORDER BY `id` ASC";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();;       
	}
}
?>
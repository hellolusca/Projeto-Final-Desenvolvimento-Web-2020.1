<?php
//error_reporting(0);
include __DIR__.'/Conexao.php';

class Providers extends Conexao {
    private $id; 
	private $company_name;
    private $cnpj;
    private $address;
    private $number;
    private $complement;
    private $cep;
    private $neighborhood;
    private $city;
    private $state;
    private $email;
    private $cellphone;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCompanyName() {
        return $this->company_name;
    }

    public function setName($company_name) {
        $this->company_name = $company_name;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getComplement() {
        return $this->complement;
    }

    public function setComplement($complement) {
        $this->complement = $complement;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getNeighborhood() {
        return $this->neighborhood;
    }

    public function setNeighborhood($neighborhood) {
        $this->neighborhood = $neighborhood;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
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
    
    public function insert($obj){
    	$sql = "INSERT INTO providers (company_name,cnpj,address,number,complement,cep,neighborhood,city,state,email,cellphone) VALUES (:company_name,:cnpj,:address,:number,:complement,:cep,:neighborhood,:city,:state,:email,:cellphone)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('company_name',  $obj->company_name);
        $consulta->bindValue('cnpj' , $obj->cnpj);
        $consulta->bindValue('address' , $obj->address);
        $consulta->bindValue('number', $obj->number);
        $consulta->bindValue('complement' , $obj->complement);
        $consulta->bindValue('cep', $obj->cep);
        $consulta->bindValue('neighborhood' , $obj->neighborhood);
        $consulta->bindValue('city' , $obj->city);
        $consulta->bindValue('state' , $obj->state);
        $consulta->bindValue('email' , $obj->email);
        $consulta->bindValue('cellphone' , $obj->cellphone);
        $consulta->execute();
        $last = $this->find(Conexao::lastId());
        $last->status = "true";
        $last->msg = "Successfully inserted";
        return $last;        
	}

	public function update($obj){
		$sql = "UPDATE providers SET 
            company_name = :company_name, 
            cnpj = :cnpj,
            address = :address, 
            number = :number,
            complement = :complement
            cep = :cep
            neighborhood = :neighborhood
            city = :city
            state = :state
            email = :email
            cellphone = :cellphone
        WHERE id = :id ";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('company_name',  $obj->company_name);
        $consulta->bindValue('cnpj' , $obj->cnpj);
        $consulta->bindValue('address' , $obj->address);
        $consulta->bindValue('number', $obj->number);
        $consulta->bindValue('complement' , $obj->complement);
        $consulta->bindValue('cep', $obj->cep);
        $consulta->bindValue('neighborhood' , $obj->neighborhood);
        $consulta->bindValue('city' , $obj->city);
        $consulta->bindValue('state' , $obj->state);
        $consulta->bindValue('email' , $obj->email);
        $consulta->bindValue('cellphone' , $obj->cellphone);
        $consulta->bindValue('id' , $obj->id);
        $consulta->execute();
        $last = $this->find($obj->id);
        $last->status = "true";
        $last->msg = "Successfully updated";
        return $last;
	}

	public function delete($id = null){
		$sql = "DELETE FROM providers WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
        return $consulta->execute();
	}

	public function find($id = null){
        $sql =  "SELECT * FROM providers WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id',$id);
        $consulta->execute();
        return $consulta->fetch();
	}

	public function findAll(){
		$sql = "SELECT * FROM providers ORDER BY `id` asc";
		$consulta = Conexao::prepare($sql);
		$consulta->execute();
		return $consulta->fetchAll();
    }

    public function count(){
        $sql =  "SELECT * FROM providers";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        $res = $consulta->rowCount();
        return $res;       
	}
}
?>
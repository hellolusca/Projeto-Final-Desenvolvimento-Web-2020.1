<?php
//error_reporting(0);
include __DIR__.'/Conexao.php';

class Products extends Conexao {
    private $id; 
	private $name;
    private $amount;
    private $unity;
    private $bought;
    private $valid_thru;
    private $provider_id;
    

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

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getUnity() {
        return $this->unity;
    }

    public function setAddress($unity) {
        $this->unity = $unity;
    }

    public function getBought() {
        return $this->bought;
    }

    public function setBought($bought) {
        $this->bought = $bought;
    }

    public function getValidThru() {
        return $this->valid_thru;
    }

    public function setValidThru($valid_thru) {
        $this->valid_thru = $valid_thru;
    }

    public function getProviderId() {
        return $this->provider_id;
    }

    public function setProviderId($provider_id) {
        $this->provider_id = $provider_id;
    }


    
    public function insert($obj){
    	$sql = "INSERT INTO products (name,amount,unity,bought,valid_thru,provider_id) VALUES (:name,:amount,:unity,:bought,:valid_thru,:provider_id)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('name',  $obj->name);
        $consulta->bindValue('amount' , $obj->amount);
        $consulta->bindValue('unity' , $obj->unity);
        $consulta->bindValue('bought', $obj->bought);
        $consulta->bindValue('valid_thru' , $obj->valid_thru);
        $consulta->bindValue('provider_id', $obj->provider_id);
        $consulta->execute();
        $last = $this->find(Conexao::lastId());
        $last->status = "true";
        $last->msg = "Successfully inserted";
        return $last;        
	}

	public function update($obj){
		$sql = "UPDATE products SET 
            name = :name, 
            amount = :amount,
            unity = :unity, 
            bought = :bought,
            valid_thru = :valid_thru
            provider_id = :provider_id
        WHERE id = :id ";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('name',  $obj->name);
        $consulta->bindValue('amount' , $obj->amount);
        $consulta->bindValue('unity' , $obj->unity);
        $consulta->bindValue('bought', $obj->bought);
        $consulta->bindValue('valid_thru' , $obj->valid_thru);
        $consulta->bindValue('provider_id', $obj->provider_id);
        $consulta->bindValue('id' , $obj->id);
        $consulta->execute();
        $last = $this->find($obj->id);
        $last->status = "true";
        $last->msg = "Successfully updated";
        return $last;
	}

	public function delete($id = null){
		$sql = "DELETE FROM products WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
        return $consulta->execute();
	}

	public function find($id = null){
        $sql =  "SELECT * FROM products WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id',$id);
        $consulta->execute();
        return $consulta->fetch();
	}

	public function findAll(){
		$sql = "SELECT * FROM products ORDER BY `id` asc";
		$consulta = Conexao::prepare($sql);
		$consulta->execute();
		return $consulta->fetchAll();
    }

    public function count(){
        $sql =  "SELECT * FROM products";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        $res = $consulta->rowCount();
        return $res;       
	}
}
?>
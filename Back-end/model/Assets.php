<?php
error_reporting(0);
include __DIR__.'/Conexao.php';

class Assets extends Conexao {
    private $id; 
	private $name;
    private $type;    
    private $code;
    private $description;
    private $sector_id;

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

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getSectorId() {
        return $this->description;
    }

    public function setSectorId($description) {
        $this->description = $description;
    }
    
    
    
    public function insert($obj){
    	$sql = "INSERT INTO assets (name,type,code,description,sector_id) VALUES (:name,:type,:code,:description,:sector_id)";
    	$consulta = Conexao::prepare($sql);
        $consulta->bindValue('name',  $obj->name);
        $consulta->bindValue('type' , $obj->type);
        $consulta->bindValue('code' , $obj->code);
        $consulta->bindValue('description', $obj->description);
        $consulta->bindValue('sector_id' , $obj->sector_id);
        $consulta->execute();
        $last = $this->find(Conexao::lastId());
        $last->status = "true";
        $last->msg = "Successfully inserted";
        return $last;
	}

	public function update($obj){
		$sql = "UPDATE assets SET 
            name = :name, 
            type = :type,
            code = :code, 
            description = :description,
            sector_id = :sector_id 
        WHERE id = :id ";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('name', $obj->name);
		$consulta->bindValue('type' , $obj->type);		
        $consulta->bindValue('code' , $obj->code);
        $consulta->bindValue('description', $obj->description);
        $consulta->bindValue('sector_id', $obj->sector_id);
		$consulta->bindValue('id', $obj->id);
        $consulta->execute();
        $last = $this->find($obj->id);
        $last->status = "true";
        $last->msg = "Successfully updated";
        return $last;
	}

	public function delete($obj,$id = null){
		$sql =  "DELETE FROM assets WHERE id = :id";
		$consulta = Conexao::prepare($sql);
		$consulta->bindValue('id',$id);
		$consulta->execute();
        return $consulta->execute();
	}

	public function find($id = null){
        $sql =  "SELECT name,type,code,description,sector_id FROM assets WHERE id = :id";
        $consulta = Conexao::prepare($sql);
        $consulta->bindValue('id',$id);
        $consulta->execute();
        return $consulta->fetch();
	}

	public function findAll(){
		$sql = "SELECT name,type,code,description,sector_id FROM login";
		$consulta = Conexao::prepare($sql);
		$consulta->execute();
		return $consulta->fetchAll();
    }

    public function count(){
        $sql =  "SELECT * FROM assets";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        $res = $consulta->rowCount();
        return $res;       
	}
}
?>
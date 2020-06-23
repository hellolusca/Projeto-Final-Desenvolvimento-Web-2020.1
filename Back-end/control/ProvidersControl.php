<?php
include __DIR__.'/../model/Providers.php';

class ProvidersControl {
	function insert($obj){		
		$providers = new Providers();	
		return $providers->insert($obj);		
	}

	function update($obj){
		$providers = new Providers();
		return $providers->update($obj);
	}

	function delete($id){
		$providers = new Providers();
		return $providers->delete($id);
	}

	function find($id = null){
		$providers = new Providers();
		return $providers->find($id);
	}

	function findAll(){
		$providers = new Providers();
		return $providers->findAll();
	}

	function count() {
		$providers = new Providers();
		return $providers->count();
	}
}
?>
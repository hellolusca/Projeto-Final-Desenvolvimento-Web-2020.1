<?php
include __DIR__.'/../model/Assets.php';

class AssetsControl {
	function insert($obj){		
		$assets = new Assets();	
		return $assets->insert($obj);		
	}

	function update($obj){
		$assets = new Assets();
		return $assets->update($obj);
	}

	function delete($id){
		$assets = new Assets();
		return $assets->delete($id);
	}

	function find($id = null){
		$assets = new Assets();
		return $assets->find($id);
	}

	function findAll(){
		$assets = new Assets();
		return $assets->findAll();
	}

	function count() {
		$assets = new Assets();
		return $assets->count();
	}
}
?>
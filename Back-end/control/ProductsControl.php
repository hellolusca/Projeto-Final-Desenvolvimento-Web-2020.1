<?php
include __DIR__.'/../model/Products.php';

class ProductsControl {
	function insert($obj){		
		$products = new Products();	
		return $products->insert($obj);		
	}

	function update($obj){
		$products = new Products();
		return $products->update($obj);
	}

	function delete($id){
		$products = new Products();
		return $products->delete($id);
	}

	function find($id = null){
		$products = new Products();
		return $products->find($id);
	}

	function findAll(){
		$products = new Products();
		return $products->findAll();
	}

	function count() {
		$products = new Products();
		return $products->count();
	}
}
?>
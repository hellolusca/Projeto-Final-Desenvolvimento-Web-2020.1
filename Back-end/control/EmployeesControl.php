<?php
include __DIR__.'/../model/Employees.php';

class EmployeesControl {
	function insert($obj){		
		$employees = new Employees();	
		return $employees->insert($obj);		
	}

	function update($obj){
		$employees = new Employees();
		return $employees->update($obj);
	}

	function delete($id){
		$employees = new Employees();
		return $employees->delete($id);
	}

	function find($id = null){
		$employees = new Employees();
		return $employees->find($id);
	}

	function findAll(){
		$employees = new Employees();
		return $employees->findAll();
	}

	function count() {
		$employees = new Employees();
		return $employees->count();
	}

	function jobs() {
		$employees = new Employees();
		return $employees->jobs();
	}

	function filter($obj) {
		$employees = new Employees();
		return $employees->filter($obj);
	}
}
?>
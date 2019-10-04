<?php

namespace Crud\Services;
//incluir model
use Crud\Model\CrudTable;

class UsersService
{
	private $usersModel;

	public function   __construct(){
		$this->usersModel = new CrudTable();
	}
	
	public function fetchAll(){
		$users=$this->usersModel->fetchAll();
		return $users;
	}
	
	public function addUser($formData){
		$data = array(
			"nombre" => $formData['nombre'],
			"correo" => $formData['correo'],
			"contrasena" => $formData['contrasena']
			);

		$user = $this->usersModel->addUser($data); 
		return $user;
	}

	public function getUserById($id_user){
		
		$user = $this->usersModel->getUserById($id_user);
		return $user;
	}

	public function updateUser($formData){
		//echo "<pre>"; print_r ($formData); exit;
		$dataa = array(
			"id" => $formData['id'],
			"nombre" => $formData['nombre'],
			"correo" => $formData['correo'],
			"contrasena" => $formData['contrasena']
			);
		$user = $this->usersModel->updateUser($dataa);
		return $user;

	}

	public function deleteUser($id_user){
		$user = $this->usersModel->deleteUser($id_user);
		return $user;

	}

}
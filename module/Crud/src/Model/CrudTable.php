<?php

namespace Crud\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\Feature;
/**
 * 
 */
class CrudTable extends TableGateway
{
	protected $tableGateway;

    private $dbAdapter;

	public function   __construct(){
		$this->dbAdapter = \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
		$this->table = 'usuarios';
		$this->featureSet = new Feature\FeatureSet();
		$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
		$this->initialize();
	}
	public function   fetchAll(){
		//select from
		$select = $this->select();
		$users = $select->toArray();
		//imprime un array
		//print_r($users);
		return $users;
	}
    
    public function  addUser($data){
		//inserta el array desde el service
		$this->insert($data);
		return $data;
	}

    public function getUserById($id_user){

		$sql = new Sql($this->dbAdapter);
		$select = $this->dbAdapter->query("select * from usuarios where id=$id_user",Adapter::QUERY_MODE_EXECUTE);
		$result = $select->toArray();

		return $result[0];
	}
	public function updateUser($dataa){
	
        $user = $this->update($dataa, array("id"=>$dataa['id']));
		return $user;
    }
    
	public function deleteUser($id_user){
		
		$delete=$this->delete(array("id"=>$id_user));
	         return $delete;
	}
 }
?>
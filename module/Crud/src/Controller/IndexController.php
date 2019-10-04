<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Crud\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Crud\Services\UsersService;
use Crud\Form\PostForm;



class IndexController extends AbstractActionController{
	
	private $userService;
	
	public function __construct(){
		$this->userService = new UsersService();
	}
//creacion de un metodo para visualizar la vista "index"
	public function indexAction(){
		$posts = $this->userService->fetchAll();
	
	//	return new ViewModel([ 'posts' => $posts ]);
		return new ViewModel(array("posts"=>$posts));
		
	}

	public function addAction(){
		$form = new PostForm();
		
		if ($this->getRequest()->isPost()) {
			
			$formData = $this->getRequest()->getPost();
			
			$user = $this->userService->addUser($formData);
				if ($user) {
					# valida que la variable tenga algo para regresarlo.
					$this->redirect()->toUrl($this->getRequest()->getBAseUrl().'/crud');
				}
		}
		return array('form'=>$form);
		
	}



	public function editAction(){
		$form = new PostForm();
		$id_user = $this->params()->fromRoute("id");
		$user = $this->userService->getUserById($id_user);
		//print_r ($user);
		$form-> setData($user);
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			//print_r ($formData);
			$user = $this->userService->updateUser($formData);
			//echo "<pre>"; print_r ($user); exit;
				if ($user) {
					$this->redirect()->toUrl($this->getRequest()->getBAseUrl().'/crud');
				}
		}
		return array('form'=>$form);
		}




	
	public function deleteAction(){
		
		$id_user = $this->params()->fromRoute("id");
			if($id_user == 0){
				exit('Error');
			}
			try{
			$post = $this->userService->deleteUser($id_user);
			} 
			catch(Exception $e){
				exit('Error');
			}
			$request =$this->getRequest();
			if(!$request->isPost()){
				return new ViewModel([
'post' => $post,
'id' => $id_user
				]);
			}
	$delete = $request->getPost('delete', 'No');
	if($delete == 'Yes'){
		$id_user = $this->params()->fromRoute("id");
		$this->userService->deleteUser($id_user);
		return $this->redirect()->toRoute('home');
	}	
	else{
		return $this->redirect()->toRoute('home');
	}
	}


	}

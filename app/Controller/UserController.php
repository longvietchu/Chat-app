<?php
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UserController extends AppController{

	public $uses = "tUser";

	// Sign-up
	public function regist(){
		if($this->request->is('post')){
			$data = $this->request->data;
			// Hashing password before save in database
			if (!empty($data['password'])) {
				$passwordHasher = new SimplePasswordHasher(array('hashType' => 'md5'));
				$data['password'] = $passwordHasher->hash($data['password']);
			}
			// Saving data after hashing
			$this->tUser->create();
			if ($this->tUser->save($data)) {
				return $this->redirect(
					array(
						'controller' => 'User', 
						'action' => 'login'
					)
				);
			}
		}
	}
	// Sign-in
	public function login(){
		if ($this->request->is('post')){
			$data = $this->request->data;

			// Hashing password before check with database
			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'md5'));
			$data['password'] = $passwordHasher->hash($data['password']);

			//check user account
			$email = $data['e-mail'];
			$password = $data['password'];

			$check_account = $this->tUser->find('first', array(
				'conditions' => array(
					'tUser.e-mail' => $email
				)
			));

			//account exist
			if($check_account){
				$userpass = $check_account['tUser']['password'];

				//account correct
				if($password == $userpass){
					//create session for user

					$this->Session->write('user.e-mail', $email);
					$this->Session->write('user.name', $check_account['tUser']['name']);

					//move to feed
					$this->redirect(array('controller' => 'Chat', 'action' => 'feed'));
				}

				//account incorrect
				else{
					$this->Flash->error(__('Incorrect account!'));
				}
			}

			//account not exist
			else{
				$this->Flash->error(__('Account does not exist!'));
			}
		}
	}

	// Sign-out
	public function logout(){
		$this->Session->destroy();
		$this->redirect(array('action' => 'login'));
	}
}
?>
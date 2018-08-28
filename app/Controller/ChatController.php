<?php 
App::uses('AppController', 'Controller');

class ChatController extends AppController{

	public $uses = "tFeed";

	public function feed($id = null){
		//check if user has logged in
		if($this->Session->check('user.e-mail')){
			//receive edit choice
			if($id){
				$edit_data = $this->tFeed->findById($id);
				if($edit_data){
					$this->Session->write('edit.id', $id);
					$this->Session->write('edit.edited', false);
					$this->set('edit_data', $edit_data);
				}
			}
			//send button clicked
			if(isset($this->request->data['send'])){
				$this->tFeed->create();

				$this->request->data['create_at'] = date("Y-m-d H:i:s");
				$this->request->data['update_at'] = date("Y-m-d H:i:s");
				
				$this->tFeed->set($this->request->data);
				if ($this->tFeed->validates()){
					if($this->tFeed->save($data)){
						return $this->redirect(array('action' => 'feed'));
					}
				}
				else {
					$errors = $this->tFeed->validationErrors;
					$this->set('errors', $errors);
				}
			}

			//edit button clicked
			if(isset($this->request->data['edit'])){
				$edited = $this->Session->read('edit.edited');

				//check if still have message to edit
				if(!$edited){
					//get message id to edit
					$id = $this->Session->read('edit.id');

					$this->tFeed->create();
					$edit_data = $this->request->data;
					$old_data = $this->tFeed->findById($id);

					//edit request before sending
					$update_at = date("Y-m-d H:i:s");
					$this->request->data['update_at'] = $update_at;
					$this->request->data['create_at'] = $old_data['tFeed']['create_at'];

					//send to Model to validate data
					$this->tFeed->set($this->request->data);

					if ($this->tFeed->validates()){
						$this->tFeed->id = $id;
						if($this->tFeed->save($this->request->data)){
							$this->Session->write('edit.edited', true);
							return $this->redirect(array('action' => 'feed'));
						}
					}
					else {
						$errors = $this->tFeed->validationErrors;
						$this->set('errors', $errors);
					}
				}
			}

			$message_views = $this->tFeed->find('all', array('order' => array('tFeed.create_at' => 'DESC')));
			$this->set(compact('message_views', 'errors'));
		}

		//not logged in
		else{
			$this->redirect(array('controller' => 'user', 'action' => 'login'));
		}
	}

	public function delete($id){
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}

		if($this->tFeed->delete($id)){
			$this->Flash->success(__("Message has been deleted!"));
		}
		else{
			$this->Flash->error(__("Error while removing message!"));
		}

		return $this->redirect(array('action' => 'feed'));
	}
}
<?php 
App::uses('Model', 'Model');

class tFeed extends Model {
	public $useTable = "t_feed";
	public $validate = array(
		"message" => array(
			"rule" => array('minLength', 1),
			"message" => "Message can't be empty!"
		)
	);
}
?>

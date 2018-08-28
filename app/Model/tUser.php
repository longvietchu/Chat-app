<?php
App::uses('Model', 'Model');
class tUser extends Model{
	public $useTable = "t_user";

	public $validate = array(
		"e-mail" => array(
			"rule" => array('minLength', 1),
			"message" => "E-mail shouldn't be empty!"
		),
		"password" => array(
			"required" => array(
				"rule" => array('minLength', 1),
				"message" => "A Password is required"
			)
		),
		"name" => array(
			"required" => array(
				"rule" => array('minLength', 1),
				"message" => "A Name is required"
			)
		)
	);
}
?>
<?php
class Submission extends AppModel{
	public $name = "Submission";
	public $displayField = "username submission";
	public $validate = array(
		'title'=>array(
			'rule'=>array('between',1, 125),
			'required' => 'true',
			'allowEmpty'=>'false',
			'message' => "Your title must be between one and one hundred characters long."
			)
		);
}
?>
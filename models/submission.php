<?php
class Submission extends AppModel{
	public $name = "Submission";
	
	public $validate = array(
		'title'=>array(
			'rule'=>array('between',1, 100),
			'required' => 'true',
			'allowEmpty'=>'false',
			'message' => 'Titles must between one and one-hundred characters long.'
			),
			
		'description1'=>array(
			'rule'=>array('between',1, 100),
			'required'=>'true',
			'allowEmpty'=>'true',
			'message'=> 'Descriptions must between one and one-hundred characters long.'
			),
			
		'text1'=>array(
			'rule'=>'notEmpty',
			'required'=>'true',
			'allowEmpty'=>'false',
			'message'=>"Other users can't read invisible code!"
		 )
		);
}
?>
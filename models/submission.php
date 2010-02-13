<?php
class Submission extends AppModel{
	public $name = "Submission";
	
	public $belongsTo = array(
		'User'=>array(
			'fields' => array('id', 'username')
		),
		
		'Topic'=>array()
		);
		
	public $hasMany = array('Comment');
		
	public $validate = array(
		'title'=>array(
			'rule'       =>array('between',1, 100),
			'required'   =>'true',
			'allowEmpty' =>'false',
			'message'    => 'Titles must between one and one-hundred characters long.'
		),
			
		'description1' =>array(
			'rule'       =>array('between',1, 100),
			'required'   =>'true',
			'allowEmpty' =>'true',
			'message'    => 'Descriptions must between one and one-hundred characters long.'
		),
			
		'text1'=>array(
			'rule'       =>'notEmpty',
			'required'   =>'true',
			'allowEmpty' =>'false',
			'message'    =>"Other users can't read invisible code!"
		),
		
		'captcha'=>array(
			'rule'       => array('checkCaptcha', 'Submission'),
			'required'   =>'true',
			'allowEmpty' =>'false',
			'message'    =>'Oh No! Try again')
		);
}
?>
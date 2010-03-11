<?php
class Submission extends AppModel{
	public $name = "Submission";
	
	public $belongsTo = array(
		'User'=>array(
			'fields' => array('id', 'username')
		),
		
		'Topic'=>array(
			'fields'=>array('id', 'title', 'user_id'))
		);
		
	public $hasMany = array('Comment');
		
	public $validate = array(
		'title'=>array(
			'rule'       =>array('between',1, 255),
			'required'   =>'true',
			'allowEmpty' =>'false',
			'message'    => 'Titles must between one and two-hundred characters long.'
		),
			
		'description1' =>array(
			'rule'       =>array('between',1, 4000),
			'required'   =>'true',
			'allowEmpty' =>'true',
			'message'    => "Please provide a description of your solution."
		),
			
		'text1'=>array(
			'rule1'      =>array(
				'rule'       =>array('between', 1, 4000),
				'required'   =>'true',
				'allowEmpty' =>'false',
				'message'    =>"Other users can't read invisible code!")
		),
		
		'captcha'=>array(
			'rule'       => array('checkCaptcha', 'Submission'),
			'required'   =>'true',
			'allowEmpty' =>'false',
			'message'    =>'Oh No! Try again.',
			'on'         =>'create')
		);
}
?>
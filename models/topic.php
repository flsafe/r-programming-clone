<?php
	class Topic extends AppModel{
		public $name = "Topic";
		
		public $belongsTo = array(
			'User'=>array(
				'fields' => array('id', 'username'))
			);
			
		public $validate = array(
			'title' => array(
				'rule1' => array(
					'rule'=>array('between', 1, 255),
					'required'=>'true',
					'allowEmpty'=>'false',
					'message'=>'Your title has to be between one and one-hundred characters long.')
			),
			
			'text'=>array(
				'rule1'=>array(
					'rule'=>array('between', 1, 16000),
					'required'=>'true',
					'allowEmpty'=>'false',
					'message'=>"You can't leave your topic text empty!")
			),
			
			'captcha'=>array(
				'rule1'=>array(
					'rule'=>array('checkCaptcha', 'Topic'),
					'required'=>'true',
					'allowEmpty'=>'false',
					'message'=>"Oh, no! Try again.")
				)
		);
	}
?>

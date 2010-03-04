<?php
class User extends AppModel{

	public $name = "User";
	
	public $validate = array(
		
		'username' => array(
			'rule1' => array(
					'rule'       => '/^[a-z0-9_]{3,45}$/i',
					'required'   => 'true' ,
					'allowEmpty' => 'false',
					'message'    => 'Only letters, numbers and underscores are allowed.'),
					
			'rule2' => array(
				'rule' => array('unique'),
				'message' => 'Shoot! Someone beat you to that username!'),
		),
			
		'email' => array(
			'rule1' => array(
					'rule' => 'email',
					'required'   => 'true' ,
					'allowEmpty' => 'false',
					'message'    => 'You have to specify a valid email address.'),
					
			 'rule2' => array(
					'rule'       => array('unique'),
					'message'    => 'That email address is already in use! Try a different email address.')
		),
			
			'password_new' => array(
				'rule1' => array(
					'rule'       => array('minLength', 6),
					'required'   => 'true',
					'allowEmpty' => 'false',
					'message'    => 'Your password must be at least 6 characters.'),
				'rule2' => array(
					'rule'       => array('confirmPassword'),
					'message'    => 'Your passwords must match.'
				)
			),
			
			'captcha' => array(
				'rule1' => array(
					'rule'       => array('checkCaptcha', 'User'),
					'required'   => 'true',
					'allowEmpty' => 'false',
					'message'    => "Shoot! Your captcha wasn't right.")
			)
		);
		
		function unique($check){
			$otherUser = $this->find('first', array('conditions' => $check, 'recursive' => -1));
			$thisUser  = $this->data;
			
			if(empty($otherUser['User']))
				return true;
			
			$insertingNewUser = !isset($this->data['User']['id']);
			
			if($insertingNewUser){
				return empty($otherUser['User']);
			}

			return $thisUser['User']['id'] == $otherUser['User']['id'];
		}
		
		function confirmPassword($check){
			return $this->data['User']['password_confirm'] == $check['password_new'];
		}
}
?>

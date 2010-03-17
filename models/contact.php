<?php
class Contact extends AppModel{
	public $name = 'Contact';
	
	public $validate = array(
		
											'name'=>array(
													'rule'       =>array('between', 0, 255),
													'required'   =>true,
													'allowEmpty' =>false,
													'message'    =>"Oops! You can't leave your name empty!"),
														
											'email'=>array(
													'rule'      =>'email',
													'message'   =>'You have to provide a valid email!',
													'allowEmpty' =>false,
													'required'   =>true),
													
												'feedback'=>array(
													'rule'    =>array('between', 0, 4000),
													'required'   =>true,
													'allowEmpty' =>false,
													'message'    =>'You have to specify some feedback!'
													));
}
?>
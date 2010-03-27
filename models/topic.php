<?php
	class Topic extends AppModel{
		public $name = "Topic";
		
		public $belongsTo = array('User'=> array('fields' => array('id', 'username')));
		
		public $hasAndBelongsToMany = array('Algorithm'=>array('classname' 		=> 'Algorithm',
																									 'joinTable' 				 		=> 'algorithms_topics',
																									 'foriegnKey'				 		=> 'topic_id',
																									 'associationForeignKey'=> 'algorithm_id',
																									 'unique'								=> 'true'),
																									
																				 'DataStructure'=>array('classname' => 'DataStructure',
																					         'joinTable' 						  => 'data_structures_topics',
																					         'foriegnKey'						  => 'topic_id',
																					         'associationForeignKey'  => 'data_structure_id',
																					         'unique'								  => 'true'));

		public $actsAs = array('Searchable');

		public $validate = array(
		'title' => array(
				'between'      => array(
					'rule'       => array('between', 1, 255),
					'required'   => 'true',
					'allowEmpty' => 'false',
					'message'    => 'Your title has to be between one and two-hundred characters long.',
					'last'			 => true)
			),

		'text'=>array(
				'between'      => array(
					'rule'       => array('between', 1, 4000),
					'required'   => 'true',
					'allowEmpty' => 'false',
					'message'    => "You can't leave your topic text empty!")
			),

		'captcha'=>array(
				'between'      => array(
					'rule'       => array('between', 0, 125),
					'message'    => 'That is one mighty long captcha.',
					'last'	     => true,
					'on'         => 'create'
				),
					
				'captcahMatch'=> array(
					'rule'       => array('checkCaptcha', 'Topic'),
					'required'   => 'true',
					'allowEmpty' => 'false',
					'message'    => "Oh, no! Try again.",
					'on'         => 'create')
				),

		'Algorithm'=>array(
				'multiple'=>array(
					'rule'=> array('multiple', array('min'=>'1', 'max'=>'20')),
					'required'=> 'true',
					'allowEmpty'=>'false',
					'message'=>" ") /*is this a fucking bug in my code or in cakephp? No mater what I put here only the first char shows*/
			),

		'DataStructure'=>array(
				'multiple'=>array(
					'rule'=>array('multiple', array('min'=>'1', 'max'=>'20')), #Just put in some kind of limit, doesn't mean anything yet
					'required'=>'true',
					'allowEmpty'=>'false',
					'message'=>' '))
);
	
	/**
	 * Move the HABTM data into the Model->data array for validation
	 */
	function beforeValidate(){
 		foreach($this->hasAndBelongsToMany as $k=>$v)
    	if(isset($this->data[$k][$k]))
      	$this->data[$this->alias][$k] = $this->data[$k][$k];

		return true;
	}
}
?>

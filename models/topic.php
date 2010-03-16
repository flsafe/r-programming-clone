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
					'rule'=>array('multiple', array('min'=>'1', 'max'=>'20')), #TODO, just put in some kind of limit, doesn't mean anything yet
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

		$this->log("Before Validate");
		$this->log(print_r($this->data, true));
		$this->log("Validation rules");
		$this->log(print_r($this->validate, true));
		
		return true;
	}
	
	function updateSelectedTopic(){
		$secondsPerInterval = 3600; /*3600 seconds an hour*/
		$updateTime         = 24;   /*update every 24 hours/intervals*/
		
		$lastUpdate     = $this->getLastTime();
    $now            = new DateTime();
    $now            = $now->format('U');

    $sinceLastUpdate = ($now - $lastUpdate) / $secondsPerInterval;
		if($sinceLastUpdate >= $updateTime){
			$this->log('updating');
			$rightNow = new DateTime();
			$this->setLastTime($rightNow->format('U'));
			
			$chooseFrom = $this->find('count', array('fields'     => 'DISTINCT Topic.id',
																	 						'conditions' => array('Topic.was_chosen'    => '0', 
																	 																  'Topic.current_topic' => '0')));
			if($chooseFrom > 1 ){
				$this->query('UPDATE topics set topics.current_topic=0 where topics.current_topic=1');
				$this->query('UPDATE topics,(select topics.id,topics.was_chosen,topics.current_topic, (topics.upvotes - topics.downvotes) as popular from topics where topics.was_chosen=0 and topics.current_topic=0 order by popular desc limit 1) as pop_query  SET topics.current_topic=1, topics.was_chosen=1 where topics.id = pop_query.id');
			}
		}
	}
	
	private function getLastTime(){
		$f = fopen('time/time', 'r');
		if(!$f){
			$f = fopen('time/time', 'w');
			$datetime = new DateTime();
			$time = $datetime->format('U');
		 	fwrite($f, $time);
			fclose($f);
			return $time;
		}
		$time = fread($f, 15);
		return $time;
	}
	
	private function setLastTime($str){
 		$f = fopen('time/time', 'w');
		if(!$f)
			return;
		fwrite($f, $str);
		fclose($f);
	}
}
?>

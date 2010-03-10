<?php
class Algorithm extends AppModel{
	public $name = 'Algorithm';
	
	public $hasAndBelongsToMany = array('Topic'=>array('classname'            => 'Algorithm',
																								     'joinTable' 						=> 'algorithms_topics',
																								     'foriegnKey'						=> 'algorithm_id',
																								     'associationForeignKey'=>'topic_id',
																								     'unique'    						=>'true'));
}
?>
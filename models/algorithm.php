<?php
class Algorithm extends AppModel{
	public $name = 'Algorithm';
	
	public $hasAndBelongsToMany = array('Topic'=>array('classname' => 'Algorithm',
																								     'joinTable' => 'algorithms_topics',
																								     'foriegnKey'=> 'topic_id',
																								     'associationForeignKey'=>'algorithm_id',
																								     'unique'    =>'true'));
}
?>
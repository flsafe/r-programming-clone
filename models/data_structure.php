<?php
class DataStructure extends AppModel{
	public $name = "DataStructure";
	
	public $hasAndBelongsToMany = array('Topic'=>array('classname' => 'DataStructure',
																								     'joinTable' => 'algorithms_topics',
																								     'foriegnKey'=> 'topic_id',
																								     'associationForeignKey'=>'data_structure_id',
																								     'unique'=>'true'));
}
?>
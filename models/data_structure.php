<?php
class DataStructure extends AppModel{
	public $name = "DataStructure";
	
	public $hasAndBelongsToMany = array('Topic'=>array('classname' 						=> 'DataStructure',
																								     'joinTable' 						=> 'data_structures_topics',
																								     'foriegnKey'						=> 'data_structure_id',
																								     'associationForeignKey'=>'topic_id',
																								     'unique'								=>'true'));
}
?>
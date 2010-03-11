<?php
App::import('Sanitize');
class Comment extends AppModel{
	public $name      = 'Comment';
	
	public $actsAs    = array('Tree');
	
	public $belongsTo = array('User' => array('fields'=>array('id', 'username')));
	
	public $validate = array(
			'text' => array(
				'rule'=>array('between', 1, 4000),
				'required'=>'true',
				'allowEmpty'=>'false')
	);
	
	#TODO: Huh, I'm not sure that this function should serve both model comments and user coments
	public function getModelComments($modelname = null, $model_id = null){
		$modelname           = strtolower($modelname);
    $modelname = Sanitize::escape($modelname);
    $model_id  = Sanitize::escape($model_id);
  	return $this->find('threaded', array('conditions'=> array("Comment.{$modelname}_id"=>$model_id),
																				 'order'     => array('Comment.created DESC')));
	}
	
	public function commentOnModel($modelname, $model_id, $parent_id, $user_id, $text){
		$modelname                   = strtolower($modelname);
		$c                           = 'Comment';
		
		$data[$c]['user_id']         = $user_id;
		$data[$c]["${modelname}_id"] = $model_id;
		$data[$c]['text']            = $text;
		
		if($parent_id)
			$data[$c]['parent_id'] = $parent_id;
			
		return $this->save($data);
	}
}
?>
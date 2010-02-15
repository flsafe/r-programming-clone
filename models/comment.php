<?php
class Comment extends AppModel{
	public $name = 'Comment';
	
	public $actsAs = array('Tree');
	
	public $belongsTo = array('User' => 
															array('fields'=>array('id', 'username')));
	
	#TODO: add the validation rules
	
	public function getModelComments($modelname = null, $model_id = null, $user_id = null){
		$getAllModelComments = $modelname && $model_id && !($user_id);
		$getAllUserComments  = !($modelname) && !($model_id) && $user_id;
		$modelname           = strtolower($modelname);
		
		if($getAllModelComments){
			#return $this->generatetreelist(array("Comment.${modelname}_id"=>$model_id), null,'{n}.Comment', '&nbsp;&nbsp;');
			return $this->find('all', array(
													'conditions'=>array("Comment.${modelname}_id"=>$model_id),
													'order'=>array('Comment.lft asc')));
		}
		elseif ($getAllUserComments){
			return $this->getneratetreelist(array('Comment.user_id'=>$user_id), '$nbsp;&nbsp');
		}
	}
	
	public function commentOnModel($modelname, $model_id, $parent_id, $user_id, $text){
		$modelname = strtolower($modelname);
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
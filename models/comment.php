<?php
class Comment extends AppModel{
	public $name = 'Comment';
	
	public $actsAs = array('Tree');
	
	public $belongsTo = array('User');
	
	#TODO: add the validation rules
	
	public getModelComments($modelname, $model_id, $user_id){
		$getAllModelComments = $modelname && $model_id && !($user_id);
		$getAllUserComments  = !($modelname) && !($model_id) && $user_id;
		
		if($getAllModelComments){
			
		}
		elseif ($getAllUserComments){
			
		}
	}
	
	public comment($modelname, $model_id, $parent_id, $user_id, $text){
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
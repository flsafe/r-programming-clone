<?php
App::import('Sanitize');
class Comment extends AppModel{
	public $name      = 'Comment';
	
	public $actsAs    = array('Tree');
	
	public $belongsTo = array('User' => array('fields'=>array('id', 'username')));
	
	#TODO: add the validation rules
	
	public function getModelComments($modelname = null, $model_id = null, $user_id = null){
		$getAllModelComments = $modelname && $model_id && !($user_id);
		$getAllUserComments  = !($modelname) && !($model_id) && $user_id;
		$modelname           = strtolower($modelname);
		
		if($getAllModelComments){
      $modelname = Sanitize::escape($modelname);
      $model_id  = Sanitize::escape($model_id);
      $user_id   = Sanitize::escape($user_id);
      return $this->query("Select Comment.id, Comment.lft, Comment.rght, Comment.text, User.username, User.id, (COUNT(parent.id)-1) AS depth 
                                          FROM comments AS Comment, 
                                               comments AS parent  
																					LEFT JOIN users as User ON (user_id = User.id)
                                          WHERE Comment.lft BETWEEN parent.lft AND parent.rght AND Comment.${modelname}_id = $model_id
                                          GROUP BY Comment.id ORDER BY Comment.lft");
		}
		elseif ($getAllUserComments){
			return $this->getneratetreelist(array('Comment.user_id'=>$user_id), '$nbsp;&nbsp');
		}
	}
	
	public function commentOnModel($modelname, $model_id, $parent_id, $user_id, $text){
		$modelname                   = Sanitize::escape($modelname);
    $model_id                    = Sanitize::escape($model_id);
		$parent_id                   = Sanitize::escape($parent_id);
    $user_id                     = Sanitize::escape($user_id);
		$text                        = Sanitize::escape($text);

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
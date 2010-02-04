<?php
class Vote extends AppModel{
	public $name = "Vote";
	
	/**
	*Up vote or down vote a model. Automatically sets the rank
	*of the object that is voted on. Doesn't allow a user to up/down vote
	*twice. User can change their vote on an object.
	*@param string $type Either 'up' or 'down'
	*@param object $model Reference to the model object that will be 
	*voted on
	*@param string $model_id The id of the model to be voted on
	*@param string $user_id The id of the user that is logged in
	*@return integer Returns (upvotes - downvotes) if the user hasn't voted
	*on the model before or changes his vote.
	*Otherwise returns null if the user vote doesn't take effect or
	*if the vote type doesn't equal up or down.
	*/
	function voteForModel($type, $model, $model_id, $user_id){
		if($type != 'up' && $type != 'down')
			return;
			
		$modelname = $model->name;
		
		$votedata = $this->find('first', 
											array('conditions'           => array(
														'Vote.user_id'         => $user_id, 
														"Vote.${modelname}_id" => $model_id)));
												
		$upvote = $type == "up" ? '1' : '0';
											
		if($votedata){
			
			$changedvote = $votedata['Vote']['upvote'] != $upvote;
			if($changedvote){
				
				$modeldata = $model->findById($model_id);
				if(empty($modeldata))
					return;
					
				$votedata['Vote']['upvote'] = $upvote;
				
				if($upvote){
					$modeldata[$modelname]['upvotes']++;
				}
				else{
					$modeldata[$modelname]['downvotes']++;
				}
				
				#TODO: Calc rank based on time
				$modeldata[$modelname]['rank'] = $modeldata[$modelname]['upvotes'] - $modeldata[$modelname]['downvotes'];
				
				$model->save($modeldata);
				$this->save($votedata);
				
				return $modeldata[$modelname]['upvotes'] - $modeldata[$modelname]['downvotes'];
			}
		}
		else{
			$modeldata = $model->findById($model_id);
			if(empty($modeldata))
				return;
			
			if($upvote)
				$up   = $modeldata[$modelname]['upvotes']++;
			else
				$down = $modeldata[$modelname]['downvotes']++;
				
			#TODO: Calculate rank based on time
			$modeldata[$modelname]['rank'] = $modeldata[$modelname]['upvotes'] - $modeldata[$modelname]['downvotes'];
			$model->save($modeldata);
			
			$modelnamelow = strtolower($modelname);
			$votedata = array('Vote'=>array(
					'user_id'            => $user_id,
					"${modelnamelow}_id" => $model_id,
					'upvote'             => $upvote,
				));
			$this->save($votedata);
			
			return $modeldata[$modelname]['upvotes'] - $modeldata[$modelname]['downvotes'];
		}
	}
}
?>
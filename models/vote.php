<?php
class Vote extends AppModel{
	public $name = "Vote";
	
	function voteForModel($type, $model, $model_id, $user_id){
		$modelname = $model->name;
		
		$votedata = $this->find('first', 
											array('conditions'=>
											array('Vote.user_id' => $user_id, "Vote.${modelname}_id" => $model_id)));
												
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
					$modeldata[$modelname]['downvotes']--;
				}
				else{
					$modeldata[$modelname]['upvotes']--;
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
<?php 
class VoteUtilComponent extends Object{
	
	/*The code in these functions was repeated in serveral controllers so I put it here instead. Not sure
	  if it actually makes things simpler but I suppose that it doesn't hurt -Frank*/
	
	public function initialize(&$controller, $settings = array()){
		$this->controller = $controller;
	}
	
	public function vote($isAjax = false, $type, $model, $votemodel, $id, $userid){
		if(! $isAjax)
			return;
			
		$points = $votemodel->voteForModel($type, $model, $id, $userid);
		return json_encode(array('points'=>$points));
	}
	
	/**
	 * Returns the user up or down-vote associated with the given model data.
	 *@param string $modelname The name of the model to get votes for.
	 *@param model $modeldata The list of model data to check votes for. Should be in the
	 *same format return by Model->find().
	 *@param Vote $votemodel A reference to a Vote model object. 
	 *@param string $userid The id of the user to get votes for. 
	 *@return Returns an associative mapping model ids to the user's up or down vote such that:
	 * array[modelid]=>"1" if the user voted up, array[modelid]=>"0" if the user voted down. 
	 *if the user did not vote then array[modelid] will not be set.
	 */
	public function getUserVotes($modelname, $modeldata, $votemodel, $userid){
		$modelids  = array();
		foreach($modeldata as $m)
			$modelids[] = $m[$modelname]['id'];
		
		$uservotes = array();
		if($userid)
			$uservotes = $votemodel->getUserVotes($modelname, $modelids, $userid);

		return $uservotes;
	}
}
?>
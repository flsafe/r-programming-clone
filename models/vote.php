<?php
class Vote extends AppModel{
	public $name = "Vote";
	
	/**
	*Up vote or down vote a model. Automatically sets the rank
	*of the object that is voted on. Doesn't allow a user to up/down vote
	*twice. User can change their vote on an object.
	*@param string $type Either 'up' or 'down'
	*@param object $model Reference to the model object that will be 
	*voted on. Must have a public name field.
	*@param string $model_id The id of the model to be voted on
	*@param string $user_id The id of the user that is logged in
  *@pram function $rankFunction The function to use to rank the model object.
	*@return integer Returns (upvotes - downvotes) if the user hasn't voted
	*on the model before or changes his vote.
	*Otherwise returns null if the user vote doesn't take effect, the vote type isn't
	*'up' or 'down' or there are not database objects with the ids provided.
	*/
	public function voteForModel($type = null, $model = null, $model_id = null, $user_id = null, $rankFunction = array('self','hackerNewsRank')){
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
					$modeldata[$modelname]['downvotes']--;
				}
				else{
					$modeldata[$modelname]['downvotes']++;
					$modeldata[$modelname]['upvotes']--;
				}
				
        $upvotes   = $modeldata[$modelname]['upvotes'];
        $downvotes = $modeldata[$modelname]['downvotes'];
        $created   = $modeldata[$modelname]['created'];
        $rank      = call_user_func($rankFunction, $upvotes, $downvotes, $created);
				$modeldata[$modelname]['rank'] = $rank;

				$model->save($modeldata);
				$this->save($votedata);
				
				return $upvotes - $downvotes;
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
				
      $upvotes = $modeldata[$modelname]['upvotes'];
      $downvotes = $modeldata[$modelname]['downvotes'];
      $created = $modeldata[$modelname]['created'];
      $rank = call_user_func($rankFunction, $upvotes, $downvotes, $created);
      $modeldata[$modelname]['rank'] = $rank;

			$model->save($modeldata);
			$modelnamelow = strtolower($modelname);
			$votedata = array('Vote' =>array(
					'user_id'            => $user_id,
					"${modelnamelow}_id" => $model_id,
					'upvote'             => $upvote,));
			$this->save($votedata);
			
			return $upvotes - $downvotes;
		}
	}
	
	/**
	*Returns an associative array mapping model ids to 
	*the user vote for that model.
	*@param $modelname The name of the model. Typicaly the Model->name field.
	*@param array $modelids An array of model ids. The function returns the user vote,
	*if a vote exists, for each model id.
	*@param string $userid The user to get the votes for.
	*@return Returns an associative array such that: array[modelid] => "1" or "0".
	*"1" is returned if the user upvoted that model, otherwise "0" if down voted. If the user did not
	*vote on the model at all then array[modelid] will not be set.
	*/
	public function getUserVotes($modelname, $modelids, $userid){
		$modelname = strtolower($modelname);
		
		$userVotes = $this->find('all',
								array('fields' => array('upvote', "${modelname}_id"),
											'conditions' => array(
												'user_id' => $userid,
												"${modelname}_id" => $modelids)));
			
		$userVotesTab = array();
		foreach($userVotes as $vote){
			$modelid = $vote['Vote']["${modelname}_id"];
			$userVotesTab[$modelid] = $vote['Vote']['upvote'];
		}
		return $userVotesTab;
	}

  /**
   *Returns the HackerNews rank based on upvotes - downvotes and hours
   *since created. Nothing stays on the front page more than a few hours.
   *@param numeric $upvotes The number of upvotes
   *@param numeric $downvotes The number of downvotes
   *@param DateTime string $created The datetime string indicating when
   *the object getting the rank was created. example: 2010-02-08 12:09:30
   *@return Returns the rank
   */
  static function hackerNewsRank($upvotes, $downvotes, $created){
    $secondsPerHour = 3600;
    $points         = $upvotes - $downvotes;
    $c              = Configure::read('codekettl.ranking.c');
    $b              = Configure::read('codekettl.ranking.b');

    $datetime       = new DateTime($created);
    $created        = $datetime->format('U');
    $now            = new DateTime();
    $now            = $now->format('U');

    $ageInHours     = ($now - $created) / $secondsPerHour;

    $rank           =  ($points)/pow(($ageInHours + $b), $c);
    return $rank;
  }
}
?>
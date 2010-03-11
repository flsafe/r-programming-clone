<?php
	class VotesController extends AppController{
		
		public $components = array('RequestHandler'); #TODO: Watchout! What does this do to ajax requests like 'vote'?
		
		public $uses       = array('Vote', 'Submission', 'Topic');
		
		public $helpers    = array('Markdown', 'SanitizeUtil', 'SyntaxHighlighter', 'CommentsBuilder', 'Translator');
		
		public $belongsTo = array('Submission', 'Topic'); #TODO: Can this be replaced with one parent class?*/
		
		public function vote( $type = null, $modelname = null, $id = null){
			$this->autoRender = false;
			
			if(! $this->RequestHandler->isAjax())
				return;
			
			if(! ($type == 'up' || $type == 'down'))
				return;

			$model = $this->__isVotableModel($modelname);
			if(!model)
				return;
				
			$userid = $this->Auth->user('id');
			if(!$userid)
				return;
				
			$this->Vote->voteForModel($type, $model, $id, $userid);
		}
		
		public function liked($modelname){
			$user_id = $this->Auth->user('id');
			if(!$user_id)
				return;
			
			$model = $this->__isVotableModel($modelname);
			if(!$model)
				return;
				
			$this->__getLikedOrDisliked(true, $model);
		}
		
		public function getUserVotes(){
			/*Nothing here*/
		}
		
		/**
		 * Displays upvoted or down voted models not included
		 * the models the user owns.
		 * If $liked is set to true, then upvoted models are displayed
		 * otherwise downvoted models are displayed.
		 */
		function __getLikedOrDisliked($liked, $model){
			$user_id = $this->Auth->user('id');
			if(!$user_id)
				return;
			$this->set('user_id', $user_id);
			
			$liked = $liked ? '1' : '0';
			
			$modelname = strtolower($model->name);
			$this->__bindToUpVotes($user_id, $model, "${modelname}_id", $liked);
			$model->unbindModel(array('hasMany'=>array('Comment')), false);
			$this->paginate = array('limit'      => '25',
															'order'      => array('Vote.created'     => 'desc'),
															'conditions' => array('Vote.upvote'      => "$liked",
															                      "User.id <>"       => $user_id));

			$models = $this->paginate($model->name);
			$this->set('models', $models);

			$modelids  = $this->Common->toIdArray($models, $model->name);
			$uservotes = $this->Vote->getUserVotes($model->name, $modelids,  $user_id);
			$this->set('uservotes', $uservotes);

			$this->set('liked', $liked);
			$this->set('modelname', $model->name);
			$this->render('liked');
		}
		
		/**
		 * Binds a users upvoted or downvoted votes to a specific model.
		 * Binds $model to to all upvotes if $upvote is true, otherwise 
		 * binds $model to all downvotes. The binding is not configure to reset
		 * after model operations.
		 */
		 function __bindToUpVotes($user_id, &$model, $foreign_key, $upvote){
			$upvote = $upvote ? '1' : '0';

			/*Get the submissions that this user upvoted*/
			$model->bindModel(array('hasOne'=>array(
																								'Vote'=> array(
																										'className'  => 'Vote',
																										'foreignKey' => $foreign_key,
																										'conditions' => array('Vote.upvote'  => $upvote,
																																				  'Vote.user_id' => $user_id),
																										'order'      => 'Vote.created DESC'))), false);
		}
		
		/**
		 * Returns false if the modelname is not votable, 
		 * otherwise returns a reference to that model
		 */
		function __isVotableModel($modelname){
				$submission = $this->Submission;
				$topic      = $this->Topic;
				$models     = array("Submission" => $submission, 
												    "Topic"      => $topic);
												
			 	if(!isset($models[$modelname]))
					return false;
				else
					return $models[$modelname];
		}
	}
?>
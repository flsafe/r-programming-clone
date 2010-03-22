<?php
App::import('Core', 'Cache');
App::import('Core', 'Configure');
class AppModel extends Model{
		function checkCaptcha($check, $modelname){
				return $check['captcha'] == $this->data[$modelname]['captcha_keystring'];
		}
		
		public function afterSave(){
			#Clear view cache for this object, and any vote data and comment data for this object
			#TODO: HACK: This is actually line item specific stuff. This needs to be refactored into 
			#some kind of line item object
			Cache::delete("{$this->name}.{$this->id}", 'default');
			Cache::delete("Vote.{$this->name}.{$this->id}");
			
			#TODO: MORE HACK
			$commentOn = "";
			$id        = "";
			if(isset($this->data['Comment'])){
				if(isset($this->data['Comment']['topic_id']) && $this->data['Comment']['topic_id'] != '0'){
					$commentOn = 'Topic';
					$id        = $this->data['Comment']['topic_id'];
				}
				elseif(isset($this->data['Comment']['submission_id']) && $this->data['Comment']['submission_id'] != '0'){
					$commentOn = 'Submission';
					$id        = $this->data['Comment']['submission_id'];
				}
			}
			Cache::delete("CommentList.{$commentOn}.{$id}", 'default');
		}
}
?>
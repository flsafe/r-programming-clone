<?php
App::import('Core', 'Cache');
class AppModel extends Model{
		function checkCaptcha($check, $modelname){
			return $check['captcha'] == $this->data[$modelname]['captcha_keystring'];
		}
		
		public function afterSave(){
			#Clear view cache for this object, and any vote data for this object
			Cache::delete("{$this->name}.{$this->id}", 'default');
			Cache::delete("Vote.{$this->name}.{$this->id}");
		}
}
?>
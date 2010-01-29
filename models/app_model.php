<?php
class AppModel extends Model{
		function checkCaptcha($check, $modelname){
			return $check['captcha'] == $this->data[$modelname]['captcha_keystring'];
		}
}
?>
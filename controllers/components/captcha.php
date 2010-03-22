<?php 
App::import('Core', 'Configure');

class CaptchaComponent extends Object
{
    function startup(&$controller)
    {
        $this->controller = $controller;
    }

    function render()
    {
        App::import('Vendor', 'kcaptcha/kcaptcha');
        $kcaptcha = new KCAPTCHA();

				$keystring;
				if(Configure::read('automatedtest') == true)
					$keystring = 'automatedtest';
				else
					$keystring = $kcaptcha->getKeyString();
        $this->controller->Session->write('captcha_keystring', keystring);
    }
}
?>

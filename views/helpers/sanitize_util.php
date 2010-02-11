<?php
class SanitizeUtilHelper extends Helper{
  
  public function htmlEsc(&$modeldata, $fields = array()){

    App::import('Sanitize');

    $this->log(print_r($modeldata, true));

    foreach($fields as $field){
     $modeldata[$field] = Sanitize::html($modeldata[$field]);
    }

    $this->log(print_r($modeldata, true));

  }
}
?>
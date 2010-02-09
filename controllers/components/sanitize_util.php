<?php
App::import('Sanitize');

class SanitizeUtilComponent extends Object{
  
  public function htmlEsc(&$modeldata, $fields = array()){
    $this->log("Before Sanitize: " . print_r($modeldata, true));

    foreach($fields as $field){
     $modeldata[$field] = Sanitize::html($modeldata[$field]);
    }

    $this->log("After Sanitize: " . print_r($modeldata, true));
  }
}
?>
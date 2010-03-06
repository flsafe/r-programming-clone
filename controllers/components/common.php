<?php 
	class CommonComponent extends Object{
		
		public function validModel($modelname){
			$validModels = array('Topic', 'Submission');
			return in_array($modelname, $validModels);
		}
		
		public function toIdArray($models, $modelname){
			$modelids = array();
			foreach($models as $m)
				$modelids[] = $m[$modelname]['id'];

			return $modelids;
		}
		
	}
?>
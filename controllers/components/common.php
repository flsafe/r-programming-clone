<?php 
	class CommonComponent extends Object{
		
		public function toIdArray($models, $modelname){
			$modelids = array();
			foreach($models as $m)
				$modelids[] = $m[$modelname]['id'];
				
			return $modelids;
		}
	}
?>
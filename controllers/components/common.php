<?php 
	class CommonComponent extends Object{
		
		public function validModel($modelname){
			$validModels = array('Topic', 'Submission');
			return in_array($modelname, $validModels);
		}
		
		public function toIdArray(&$models, $modelname){
			$modelids = array();
			foreach($models as $m)
				$modelids[] = $m[$modelname]['id'];

			return $modelids;
		}
		
		public function getUserOwned(&$model, $model_id, $user_id){
			$data = $model->find('first', array('conditions'=>array("{$model->name}.user_id" => $user_id,
			                                                         "{$model->name}.id"     => $model_id)));
			if(! empty( $data))
				return $data;
			else
				return false;
		}
	}
?>
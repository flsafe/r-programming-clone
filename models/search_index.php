<?php
/*
http://blogu.lu/dreamproduction/
http://code.google.com/p/searchable-behaviour-for-cakephp/

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.*/

/**
 * Implements the logic behind the search box. I've modified it
 * to return only the id field of the matches that are found. 
 * 
 */
class SearchIndex extends AppModel {
	var $name = 'SearchIndex';
	var $useTable = 'search_index';
	private $models = array();

	private function bindTo($model) {
		$this->bindModel( 
			array(
				'belongsTo' => array(
					$model => array (
						'className' => $model,
						'conditions' => 'SearchIndex.model = \''.$model.'\'',
						'foreignKey' => 'association_key',
						'fields'     => array('id')
					)
				)
			),false 
		);
	}
	
	function searchModels($models = array()) {
		if (is_string($models)) $models = array($models);
		$this->models = $models;
		foreach ($models as $model) {
			$this->bindTo($model);
		}
	}
		
	function beforeFind($queryData) {
		$models_condition = false;
		if (!empty($this->models)) {
			$models_condition = array();
			foreach ($this->models as $model) {
				$Model = ClassRegistry::init($model);
				$models_condition[] = $model . '.'.$Model->primaryKey.' IS NOT NULL'; 
			}
		}
		
		if (isset($queryData['conditions'])) {
			if ($models_condition) {
				if (is_string($queryData['conditions'])) {
					$queryData['conditions'] .= ' AND (' . join(' OR ',$models_condition) . ')';
				} else {
					$queryData['conditions'][] = array('OR' => $models_condition);
				}
			}
		} else {
			if ($models_condition) {
				$queryData['conditions'][] = array('OR' => $models_condition);
			}
		}
		return $queryData; 	
	}
}
?>
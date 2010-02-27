<?php 
	#params modelname, model_id, username, user_id
	
	function get($left, &$comments){

		if(empty($comments))
			return null;
		
		$l = 0;
		$u = count($comments) - 1;
		
		while($l <= $u){
			$mid     = intval(($l + $u) / 2);
			$comment = $comments[$mid];
			
			if($comment['Comment']['lft'] == $left)
				return $comment;

			if($left < $comments[$mid]['Comment']['lft'])
				$u = $mid - 1;
			else
				$l = $mid + 1;
		}
		
		return null;
	}
	
	function nextSibling(&$comment, &$rootComment, &$comments){
		$nextLeftVal = $comment['Comment']['rght'] + 1;
		$noSibling   = $nextLeftVal >= $rootComment['Comment']['rght'];
		
		if($noSibling)
			return null;
			
		return get($nextLeftVal, $comments);
	}
	
	function getChildren(&$rootComment, &$comments){
		$noChildren = $rootComment['Comment']['lft']+ 1 == $rootComment['Comment']['rght'];
		
		if($noChildren)
			return array();
		
		/*I will buy the childrens a school bus, so they can go on field trips*/
		$childrens   = array(); 
		$firstChild  = get($rootComment['Comment']['lft'] + 1, $comments);
		$childrens[] = $firstChild;
		
		$nextChild = $firstChild;
		while(($nextChild = nextSibling($nextChild, $rootComment, $comments)) != null){
			$childrens[] = $nextChild;
		}
		
		return $childrens;
	}
	
	function createFormElem($commentid, &$comment, &$dom){
		$commentForm = $dom->createElement('form');
		$commentForm->setAttribute('class', 'replyform');
		
		$hidden = $dom->createElement('input');
		$hidden->setAttribute('type', 'hidden');
		$hidden->setAttribute('value', $commentid);
		$hidden->setAttribute('name', 'commentid');

		$commentForm->appendChild($hidden);
		
		$textDiv = $dom->createElement('div', $comment['Comment']['text']);
		$textDiv->setAttribute('class', 'commenttext');
		$commentForm->appendChild($textDiv);

		return $commentForm;
	}
	
	function createCommentDiv($rootComment, $dom){
			$topOfTree  = $rootComment[0]['depth'] == 0;

			$commentDiv = $dom->createElement('div');
			$class      = $topOfTree ? 'rootcomment' : 'childcomment';
			$commentDiv->setAttribute('class', $class);

			$commentDiv->appendChild(createFormElem($rootComment['Comment']['id'],
															$rootComment, 
															$dom));
			
			return $commentDiv;
	}
	
	function getComments(&$rootComment, &$comments, &$dom){
		$children = getChildren($rootComment, $comments);
			
		$replys   = array();
		foreach($children as $c){
			$replys[] = getComments($c, $comments, $dom);
		}
		
		$commentDiv = createCommentDiv($rootComment, $dom);
		
		foreach($replys as $r){
			$commentDiv->appendChild($r);
		}
		
		$topOfTree  = $rootComment[0]['depth'] == 0;
		if($topOfTree)
			$dom->appendChild($commentDiv);
		else
			return $commentDiv;
	}
	
	function buildCommentHiearchy(&$comments, &$doc){
		if(empty($comments))
			return;
			
		$rootComments   = array();
		
		$nextRoot       = $comments[0];
		$rootComments[] = $nextRoot;
		
		while(($nextRoot = get($nextRoot['Comment']['rght'] + 1, $comments)) != null)
			$rootComments[] = $nextRoot;
		
		foreach($rootComments as $root){
			getComments($root, $comments, $doc);
		}
	}
	
	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
	$doc      = new DOMDocument();
	buildCommentHiearchy($comments, $doc);
?>

<div id="comments">
	
	<form id="newcommentform">
		<textarea id="newcommentformtext"></textarea>
		<input id="modelname" value="<?php echo $modelname ?>" type="hidden"/>
		<input id="model_id" value="<?php echo $model_id ?>" type="hidden"/>
		<input id="submitcomment" type="submit" value="Comment"/>
	</form>

	<div id="commentslist">
		<?php echo $doc->saveHtml(); ?>
	</div>

</div>	

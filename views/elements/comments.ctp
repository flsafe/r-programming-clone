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
	
	function getComments(&$rootComment, &$comments, &$dom){
		$children = getChildren($rootComment, $comments);
			
		$replys = array();
		foreach($children as $c){
			$replys[] = getComments($c, $comments, $dom);
		}
		
		$topOfTree = $rootComment[0]['depth'] == 0;
		
		$element   = $dom->createElement('div', $rootComment['Comment']['text']);
		$class     = $topOfTree ? 'rootcomment' : 'childcomment';
		$element->setAttribute('class', $class );
		
		foreach($replys as $r){
			$element->appendChild($r);
		}
		
		if($topOfTree)
			$dom->appendChild($element);
		else
			return $element;
	}
	
	function buildCommentHiearchy(&$comments, &$doc, &$t){
		if(empty($comments))
			return;
			
		$rootComments   = array();
		
		$nextRoot       = $comments[0];
		$rootComments[] = $nextRoot;
		
		while(($nextRoot = get($nextRoot['Comment']['rght'] + 1, $comments)) != null){
			$rootComments[] = $nextRoot;
		}
		
		$t->log("Hello");
		$t->log(print_r($rootComments, true));
				
		foreach($rootComments as $root){
			getComments($root, $comments, $doc);
		}
	}
	
	$comments = $this->requestAction("comments/model_comments/${modelname}/${model_id}");
	$doc      = new DOMDocument();
	buildCommentHiearchy($comments, $doc, $this);
	
	$this->log($doc->saveHtml());
?>
<div id="comments">
	
	<form id="commentsform">
		<textarea id="commenttext">
		</textarea>
		<input id="modelname" value="<?php echo $modelname ?>" type="hidden"/>
		<input id="model_id" value="<?php echo $model_id ?>" type="hidden"/>
		<input id="submitcomment" type="submit" value="Comment"/>
	</form>

<div id="commentslist">
	
<?php foreach($comments as $comment): ?>

	<div id="<?php echo "comment{$comment['Comment']['id']}" ?>" class="comment">

		<?php 
			$level  = $comment[0]['depth'];
			$indent = "";
			$sp     = '&nbsp;&nbsp;&nbsp;';
		
			for($i = 0 ; $i < $level ; $i++)
				$indent = $indent.$sp;
			
			if($level == 0)
					echo '<br/>';
				
			$sanitizeUtil->htmlEsc($comment['Comment'], array('text'));
			$sanitizeUtil->htmlEsc($comment['User']['username'], array('text'));
		?>
			
		<?php echo $indent . $comment['User']['username'].':&nbsp;'. $comment['Comment']['text'];?>
		<a href='#' id="<?php echo "reply{$comment['Comment']['id']}" ?>" class="reply" onClick="return false;">reply</a>
	
		<?php		
			$id = $comment['Comment']['id'];
			$text = <<<EOT
				<script type="text/javascript" charset="utf-8">
				 /*<![CDATA[*/
					replyTo = $("#reply{$comment['Comment']['id']}");
					replyTo.data("meta", {modelname: "$modelname", model_id: "$model_id", id: "$id", level:"$level"});
				 /*]]>*/
			  </script>
EOT;
			echo $text;
		?>
	
	</div>
	
<?php endforeach;?>

</div>	

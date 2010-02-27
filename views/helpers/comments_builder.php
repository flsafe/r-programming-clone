<?php
class CommentsBuilderHelper extends AppHelper{
	
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
			
		return $this->get($nextLeftVal, $comments);
	}
	
	function getChildren(&$rootComment, &$comments){
		$noChildren = $rootComment['Comment']['lft']+ 1 == $rootComment['Comment']['rght'];
		
		if($noChildren)
			return array();
		
		/*I will buy the childrens a school bus, so they can go on field trips*/
		$childrens   = array(); 
		$firstChild  = $this->get($rootComment['Comment']['lft'] + 1, $comments);
		$childrens[] = $firstChild;
		
		$nextChild = $firstChild;
		while(($nextChild = $this->nextSibling($nextChild, $rootComment, $comments)) != null){
			$childrens[] = $nextChild;
		}
		
		return $childrens;
	}
	
	private function timeAgo($now, $created){
		$diff = $now - $created;
		$this->log("created: $created now: $now");
		$timeAgo = "";
		
		$secondsPerHour  = 3600;
		$secondsPerDay   = $secondsPerHour * 24;
		$secondsPerMonth = $secondsPerDay * 30; /*Not worried about being exactly accurate*/
		$secondsPerYear  = $secondsPerMonth * 12;
		$secondsPerMin   = 60;

		if($diff > $secondsPerYear){
			$t       = floor($diff / $secondsPerYear);
			$s       = $t == 1 ? '':'s';
			$timeAgo = "$t year{$s} ago";
		}
		elseif($diff > $secondsPerMonth){
			$t       = floor($diff / $secondsPerMonth);
			$s       = $t == 1 ? '':'S';
			$timeAgo = "$t month{$s} ago";
		}
		elseif($diff > $secondsPerDay){
			$t       = floor($diff / $secondsPerDay);
			$s       = $t == 1 ? '':'s';
			$timeAgo = "$t day{$s} ago";
		}
		elseif($diff > $secondsPerHour){
			$t       = floor($diff / $secondsPerHour);
			$s       = $t == 1 ? '':'s';
			$timeAgo = "$t hour{$s} ago";
		}
		elseif($diff > $secondsPerMin){
			$t = floor($diff / $secondsPerMin);
			$s = $t == 1 ? '':'s';
			$timeAgo = "$t minute{$s} ago";
		}
		else{
			$timeAgo = "$diff seconds ago";
		}
		
		return $timeAgo;
	}
	
	function createFormElem($commentid, &$comment, &$dom){
		$commentForm = $dom->createElement('form');
		$commentForm->setAttribute('class', 'replyform');
		
		$hidden = $dom->createElement('input');
		$hidden->setAttribute('type', 'hidden');
		$hidden->setAttribute('value', $commentid);
		$hidden->setAttribute('name', 'commentid');

		$commentForm->appendChild($hidden);
		
		
		$commentMeta = $dom->createElement('span');
		$commentMeta->setAttribute('class', 'commentmeta');
		
		$datetime    = new DateTime($comment['Comment']['created']);
		$created     = $datetime->format('U');
		$now         = new DateTime();
		$now         = $now->format('U');
		$timeAgo = $this->timeAgo($now, $created);
			
		$username = $comment['User']['username'];			
		$commentMeta->appendChild($dom->createTextNode("by {$username} {$timeAgo}"));
		
		
		$textp = $dom->createElement('p', $comment['Comment']['text']);
		$textp->setAttribute('class', 'commenttext');
		$commentForm->appendChild($commentMeta);
		$commentForm->appendChild($textp);

		return $commentForm;
	}
	
	function createCommentDiv($rootComment, $dom){
			$topOfTree  = $rootComment[0]['depth'] == 0;

			$commentDiv = $dom->createElement('div');
			$class      = $topOfTree ? 'rootcomment' : 'childcomment';
			$commentDiv->setAttribute('class', $class);

			$commentDiv->appendChild($this->createFormElem($rootComment['Comment']['id'],
															$rootComment, 
															$dom));
			
			return $commentDiv;
	}
	
	function getComments(&$rootComment, &$comments, &$dom){
		$children = $this->getChildren($rootComment, $comments);
			
		$replys   = array();
		foreach($children as $c){
			$replys[] = $this->getComments($c, $comments, $dom);
		}
		
		$commentDiv = $this->createCommentDiv($rootComment, $dom);
		
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
		
		while(($nextRoot = $this->get($nextRoot['Comment']['rght'] + 1, $comments)) != null)
			$rootComments[] = $nextRoot;
		
		foreach($rootComments as $root){
			$this->getComments($root, $comments, $doc);
		}
	}
}
?>
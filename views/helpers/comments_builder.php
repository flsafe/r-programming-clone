<?php
class CommentsBuilderHelper extends AppHelper{
	/**
	 * Used to display the little 'reply' link under comment text.
	 * These aren't shown when the use is not loggedin.
	 */
	public $displayReplys = false;
	
	/**
	*Used to process comment data from the data base
	*/
	private $markdown;
	private $sanitizeUtil;
	
	/**
	 * Get the comment with its Comment.lft field
	 * equal to $left 
	 */
	private function get($left, &$comments){

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
	
	/**
	 * Get the next sibling of $comment. $rootComment
	 * is the parent of $comment.
	 */
	private function nextSibling(&$comment, &$rootComment, &$comments){
		$nextLeftVal = $comment['Comment']['rght'] + 1;
		
		$noSibling   = $nextLeftVal >= $rootComment['Comment']['rght'];
		if($noSibling)
			return null;
			
		return $this->get($nextLeftVal, $comments);
	}
	
	/**
	 * Get the children of $rootComment.
	 */
	private function getChildren(&$rootComment, &$comments){
		$noChildren = $rootComment['Comment']['lft'] + 1 == $rootComment['Comment']['rght'];
		
		if($noChildren)
			return array();
		
		/*I will buy the childrens a school bus, so they can go on field trips*/
		$childrens   = array(); 
		$firstChild  = $this->get($rootComment['Comment']['lft'] + 1, $comments);
		$childrens[] = $firstChild;
		
		$nextChild   = $firstChild;
		while(($nextChild = $this->nextSibling($nextChild, $rootComment, $comments)) != null){
			$childrens[] = $nextChild;
		}
		
		return $childrens;
	}
	
	/**
	 * Returns a rough estimate of how long ago
	 * $created is compared to $now. Returns
	 * a string in the form '(N) [years,months, days, hours, minutes, seconds] ago'.
	 * 
	 */
	private function timeAgo($now, $created){
		$diff            = $now - $created;
		$timeAgo         = "";
		
		$secondsPerHour  = 3600;
		$secondsPerDay   = $secondsPerHour * 24;
		$secondsPerMonth = $secondsPerDay * 30;
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
			$t       = floor($diff / $secondsPerMin);
			$s       = $t == 1 ? '':'s';
			$timeAgo = "$t minute{$s} ago";
		}
		else{
			$timeAgo = "$diff seconds ago";
		}
		
		return $timeAgo;
	}
	
	/**
	 * Each comment is stored in a form containing hidden
	 * fields that help identify the comment on replies, meta data, and the
	 * comment text.
	 */
	private function createFormElem($commentid, &$comment, &$dom){
		$commentForm = $dom->createElement('form');
		$commentForm->setAttribute('class', 'replyform');
		
		/*Identifiying data for replies to this comment*/
		$hidden = $dom->createElement('input');
		$hidden->setAttribute('type', 'hidden');
		$hidden->setAttribute('value', $commentid);
		$hidden->setAttribute('name', 'commentid');
		$commentForm->appendChild($hidden);
		
		/*Meta data*/
		$commentMeta = $dom->createElement('span');
		$commentMeta->setAttribute('class', 'commentmeta');
		
		$datetime    = new DateTime($comment['Comment']['created']);
		$created     = $datetime->format('U');
		$now         = new DateTime();
		$now         = $now->format('U');
		$timeAgo     = $this->timeAgo($now, $created);
			
		$username    = $comment['User']['username'];			
		$commentMeta->appendChild($dom->createTextNode("by {$username} {$timeAgo}"));
		
		/*Append the meta and comment text*/
		$commentForm->appendChild($commentMeta);
		
		$this->sanitizeUtil->htmlEsc($comment['Comment'], array('text'));
		$commentDoc  = new DOMDocument();
		$t           = $this->markdown->parse($comment['Comment']['text']);
		if($commentDoc->loadHTML("<div class=\"commenttext\">$t</div>")){
			try{
				$textnode    = $commentDoc->getElementsByTagName('div')->item(0);
				$textnode    = $dom->importNode($textnode, true);
				$commentForm->appendChild($textnode);
			}
			catch(Exception $e){/*Nothing to do*/}
	 	}

		/*Reply links are visible if the user is logged in*/
		if($this->displayReplys){
			$replyLink = $dom->createElement('a', 'reply');
			$replyLink->setAttribute('href', '#');
			$replyLink->setAttribute('class', 'reply');
			$commentForm->appendChild($replyLink);
		}

		return $commentForm;
	}
	
	/**
	 * Each comment is inside a div. The div itself contains
	 * a form with the comment data in it, followed
	 * by more comment divs.
	 */
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
	
	/*
	*Build the html comments bottom to top starting
	*with the leaf comments.
	*/
	private function getComments(&$rootComment, &$comments, &$dom){
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
	
	/**
	 * Builds a a div structure containing nested
	 * comments. The html structure is written to $dom.
	 */
	function buildCommentHiearchy(&$comments, &$doc, $markdown, $sanitizeUtil){
		if(empty($comments))
			return;
			
		$this->markdown     = $markdown;
		$this->sanitizeUtil = $sanitizeUtil;
		
		/*Comments are a forest. Get all the root comments
		  so we can build the nested comment structure for each.*/
		$rootComments       = array();
		$nextRoot           = $comments[0];
		$rootComments[]     = $nextRoot;
		while(($nextRoot = $this->get($nextRoot['Comment']['rght'] + 1, $comments)) != null)
			$rootComments[] = $nextRoot;
		
		foreach($rootComments as $root){
			$this->getComments($root, $comments, $doc);
		}
	}
}
?>
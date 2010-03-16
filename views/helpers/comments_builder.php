<?php
/**
 * Builds the HTML to display the nested comment hierarchy
 */

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
	 * If a comments that match this user_id are shown with 
	 * an edit link
	 */
	 private $user_id;
	
	/**
	 * Used to create edit links
	 */
	 public $helpers = array('Html');
	
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
	private function createFormElem(&$comment, &$dom){
		$commentForm = $dom->createElement('form');
		$commentForm->setAttribute('class', 'replyform');
		$commentForm->setAttribute('id', "comment{$comment['Comment']['id']}");
		
		/*Identifiying data for replies to this comment*/
		$hidden = $dom->createElement('input');
		$hidden->setAttribute('type', 'hidden');
		$hidden->setAttribute('value', $comment['Comment']['id']);
		$hidden->setAttribute('name', 'commentid');
		$commentForm->appendChild($hidden);
		
		/*Meta data and the edit link*/
		$commentMeta = $dom->createElement('span');
		$commentMeta->setAttribute('class', 'commentmeta');
		
		$datetime    = new DateTime($comment['Comment']['created']);
		$created     = $datetime->format('U');
		$now         = new DateTime();
		$now         = $now->format('U');
		$timeAgo     = $this->timeAgo($now, $created);

		$editLink    = false;
		if($this->user_id == $comment['User']['id']){
			$edit      = $this->Html->url(array('controller'=>'comments', 'action'=>'edit', 'id'=>$comment['Comment']['id']));
			$editLink  = $dom->createElement('a', 'edit');
			$editLink->setAttribute('href', $edit);
		}
		
		$username  = $comment['User']['username'];
		$edit      = $editLink ? "| " : "";
		$commentMeta->appendChild($dom->createTextNode("by {$username} {$timeAgo} {$edit}"));
		if($editLink != false){
			$commentMeta->appendChild($editLink);
		}
		
		/*Append the meta and comment text*/
		$commentForm->appendChild($commentMeta);
		
		$this->sanitizeUtil->htmlEsc($comment['Comment'], array('text'));
		$commentDoc  = new DOMDocument();
		$t           = $this->markdown->parse($comment['Comment']['text']);
		if($commentDoc->loadHTML("<span class=\"commenttext\">$t</span>")){
			try{
				$textnode    = $commentDoc->getElementsByTagName('span')->item(0);
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
	 * by more comment divs (recursively).
	 */
	function createCommentDiv($rootComment, $dom){
			$topOfTree  = $rootComment['Comment']['parent_id'] == 0;

			$commentDiv = $dom->createElement('div');
			$class      = $topOfTree ? 'rootcomment' : 'childcomment';
			$commentDiv->setAttribute('class', $class);

			$commentDiv->appendChild($this->createFormElem($rootComment, $dom));
			
			return $commentDiv;
	}
	
	/*
	*Build the html comments bottom to top starting
	*with the leaf comments.
	*/
	private function getComments(&$rootComment, &$dom){
		$children = $rootComment['children'];
			
		$replys   = array();
		foreach($children as $c){
			$replys[] = $this->getComments($c, $dom);
		}
		
		$commentDiv = $this->createCommentDiv($rootComment, $dom);
		
		foreach($replys as $r){
			$commentDiv->appendChild($r);
		}
		
		$topOfTree  = $rootComment['Comment']['parent_id'] == 0;
		if($topOfTree)
			$dom->appendChild($commentDiv);
		else
			return $commentDiv;
	}
	
	/**
	 * Builds a a div structure containing nested
	 * comments. The html structure is written to $dom.
	 */
	function buildCommentHiearchy($user_id, &$comments, &$doc, $markdown, $sanitizeUtil){
		if(empty($comments))
			return;
		
		$this->markdown     = $markdown;
		$this->sanitizeUtil = $sanitizeUtil;
		$this->user_id      = $user_id;
		
		/*Comments are a forest, processes each comment tree*/
		foreach($comments as $root){
			$this->getComments($root, $doc);
		}
	}
}
?>
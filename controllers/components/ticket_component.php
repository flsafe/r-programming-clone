<?php
class TicketComponent{
	
	function set($info = null) extends Object{
		$this->garbage();
		
		if($info){
			
			$data['Ticket']['hash'] = md5(time());
			$data['Ticket']['info'] = $info;
			
			$ticket = new Ticket();
			
			if($ticket->save($data))
				return $data['Ticket']['hash'];
		}
	}
	
	function get($hash = null){
		$this->garbage();
		
		if($hash){
			$ticket = new Ticket();
			$data   = $ticket->findByHash($hash);
			
			if(!empty($data)){
				$this->del($data['Ticket']['id']); #Auto delete ticket after use
				return $data['Ticket']['info'];
			}
		}
	}
	
	function del($hash = null){
		if($hash){
			$ticket = new Ticket();
			
			$data = $ticket->findByHash($hash);
			if(!empty($data)){
				return $ticket->del($data['Ticket']['id']);
			}
		}
	}
	
	function garbage(){
		$deadline = data('Y-m-d H:i:s', time() - (24 * 60 * 60));
		$ticket   = new $Ticket();
		$ticket->query("DELETE from tickets WHERE created < $deadline");
	}
}
?>
<?php
App::import('Model', 'Ticket');

class TicketComponent extends Object{
	
	function set($data = null){
		$this->garbage();
		
		if($data){
			
			$ticketdata['Ticket']['hash'] = md5(time());
			$ticketdata['Ticket']['data'] = $data;
			
			$ticket = new Ticket();
			
			if($ticket->save($ticketdata))
				return $ticketdata['Ticket']['hash'];
		}
	}
	
	function get($hash = null){
		$this->garbage();
		
		if($hash){
			$ticket = new Ticket();
			$ticketdata   = $ticket->findByHash($hash);
			
			if(!empty($ticketdata)){
				return $ticketdata['Ticket']['data'];
			}
		}
	}
	
	function del($hash = null){
		if($hash){

			$ticket = new Ticket();
			
			$ticketdata = $ticket->findByHash($hash);
			if(!empty($ticketdata)){
				return $ticket->del($ticketdata['Ticket']['id']);
			}
		}
	}
	
	function garbage(){
		$deadline = date('Y-m-d H:i:s', time() - (24 * 60 * 60));
		$ticket   = new Ticket();
		$ticket->query("DELETE from tickets WHERE created < '$deadline'");
	}
}
?>
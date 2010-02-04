$(document).ready(function(){
	
	$('.upvote').click(function(){
		var topicid = $(this).attr('id');

		$.post('/topics/vote/up/' + topicid, function(data){
			
				try{
					var resp = JSON.parse(data);
					if(resp.points == null)
						return;

					$('#points'+topicid ).html(resp.points + ' points |');
				}
				catch(err){
					/*The server returns null if the user was not logged in*/
				}
			});
	});
	
	$('.downvote').click(function(){
		var topicid = $(this).attr('id');

		$.post('/topics/vote/down/' + topicid, function(data){
			
				try{
					var resp = JSON.parse(data);
					if(resp.points == null)
						return;

					$('#points' + topicid ).html(resp.points + ' points |');
				}
				catch(err){
					/*The server returns null if the user was not logged in*/
				}
			});
	});
	
});
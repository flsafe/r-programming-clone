
$(document).ready(function(){
	
	$('.upvote').click(function(){
		var topicid = $(this).attr('id');

		$.post('/'+controller+'/vote/up/' + topicid, function(data){
			
				try{
					var resp = JSON.parse(data);
					if(resp.points == null)
						return;

					$('#points'+topicid ).html(resp.points + ' points |');
				}
				catch(err){/*Empty string is returned if user is not logged in*/
				    window.location = "/users/login";
				}
			});
	});
	
	$('.downvote').click(function(){
		var topicid = $(this).attr('id');

		$.post('/'+controller+'/vote/down/' + topicid, function(data){
			
				try{
					var resp = JSON.parse(data);
					if(resp.points == null)
						return;

					$('#points' + topicid ).html(resp.points + ' points |');
				}
				catch(err){
                    window.location = '/users/login';
				}
			});
	});
});
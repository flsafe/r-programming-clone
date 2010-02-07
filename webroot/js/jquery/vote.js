
function vote(type, model, id){
    $.post('/votes/vote/'+type+'/'+model+'/'+id, function(data){
	
    		try{
    			var resp = JSON.parse(data);
    		
    			if(resp.points == null)
    				return;/*The user already voted on it, so the vote doesn't take effect*/
    				
    			$('#points'+id ).html(resp.points + ' points |');

    			var src;
    			var imgid;
    			if(type == "up"){
			        src = '/img/up_arrow_red.gif';
			        imgid = '#upvoteimg';
			    }
    			else{
    			    src = '/img/down_arrow_red.gif';
    			    imgid = '#downvoteimg'
			    }
			    imgid += id;
			    
			    $('#upvoteimg'+id).attr('src','/img/up_arrow.gif');
			    $('#downvoteimg'+id).attr('src','/img/down_arrow.gif');
			    $(imgid).attr('src', src);
    		}
    		catch(err){/*Empty string is returned if user is not logged in*/
    		    //window.location = "/users/login";
    		}});
}

$(document).ready(function(){
	$('.upvote').click(function(){
		var modelid = $(this).attr('id').replace("upvote","");
        vote("up", model, modelid);
        });
	
	$('.downvote').click(function(){
		var modelid = $(this).attr('id').replace("downvote","");
        vote("down", model, modelid);
        });
});

function vote(cntrl, type, id){
    $.post('/' + cntrl + '/vote/' + type + '/' + id, function(data){
	
    		try{
    			var resp = JSON.parse(data);
    			if(resp.points == null)
    				return;/*Some kind of server error*/

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
    		    window.location = "/users/login";
    		}});
}


$(document).ready(function(){
	$('.upvote').click(function(){
		var topicid = $(this).attr('id').replace("upvote","");
        vote(controller,"up",topicid);
        });
	
	$('.downvote').click(function(){
		var topicid = $(this).attr('id').replace("downvote","");
        vote(controller,"down",topicid);
        });
});
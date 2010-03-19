/**
*Client side vote logic. Take a look at the vote.ctp file
*to see all the html.
*/

//No javascript trim function? Puh-leeze
String.prototype.trim = function () {
  return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1");
};

//These are the up and down vote arrow images that
//change when the user upvotes or downvotes
up      = '/img/up_arrow.gif';
down    = '/img/down_arrow.gif';
upred   = '/img/up_arrow_red.gif';
downred = '/img/down_arrow_red.gif';

function alreadyVoted(type, id){
    voted =   type == 'up'  && $('#upvoteimg'+id).attr('src')   == upred
           || type == 'down'&& $('#downvoteimg'+id).attr('src') == downred;

    return voted;
}

function vote(type, model, id){
   if(alreadyVoted(type, id))
        return;
        
    $.post('/votes/vote/'+type+'/'+model+'/'+id, function(data){
        //Nothing here yet
    });
}

function getHtmlId(type, id){
	var imgid;
	if(type == "up"){
        imgid = '#upvoteimg';
    }
	else{
	    imgid = '#downvoteimg'
    }
    return imgid += id;
}

function changeVoteDisplay(type, id){
    if(alreadyVoted(type,id))
        return;
        
    points = $('#points'+id ).html().trim();
    points = parseInt(points) + (type == 'up' ? 1 : -1);
    $('#points'+id).html(points + " points | by ");
    
    $('#upvoteimg'+id).attr('src', up);
    $('#downvoteimg'+id).attr('src', down);
    src   = type == "up" ? upred : downred;
    imgid = getHtmlId(type,id);
    $(imgid).attr('src', src);
}

$(document).ready(function(){
    //The up/down vote id(s) are in the form 'upvote(N)' or 'downvote(N)' where (N) is the 
    //id of the model object the user is voting on. This convention is followed for
    //points(N) and images so you'll see this type of replace in several places.
    
	$('.upvote').click(function(){
        if(bailIfNotLoggedIn())
            return;
    
    	var modelid = $(this).attr('id').replace("upvote","");

        vote("up", model, modelid);
        changeVoteDisplay('up', modelid);
    });

	
	$('.downvote').click(function(){
        if(bailIfNotLoggedIn())
            return;
	        
		var modelid = $(this).attr('id').replace("downvote","");
        vote("down", model, modelid);
        changeVoteDisplay('down', modelid);
    });
    
});
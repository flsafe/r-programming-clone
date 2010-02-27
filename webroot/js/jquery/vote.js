/**
*Client side vote logic. Take a look at the vote.ctp file
*to see where all the html.
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

function vote(type, model, id){
    $.post('/votes/vote/'+type+'/'+model+'/'+id, function(data){
        //Nothing here yet
    });
}

function changeVoteDisplay(type, id){
    alreadyVoted =    type == 'up'  && $('#upvoteimg'+id).attr('src')   == upred
                   || type == 'down'&& $('#downvoteimg'+id).attr('src') == downred;
                   
    if(alreadyVoted)
        return;
        
    points = $('#points'+id ).html().trim();
    points = parseInt(points) + (type == 'up' ? 1 : -1);
    $('#points'+id).html(points);
    
    var src;
	var imgid;
	if(type == "up"){
        src = upred;
        imgid = '#upvoteimg';
    }
	else{
	    src = downred;
	    imgid = '#downvoteimg'
    }
    imgid += id;

    $('#upvoteimg'+id).attr('src', up);
    $('#downvoteimg'+id).attr('src', down);
    $(imgid).attr('src', src);
}

$(document).ready(function(){
	$('.upvote').click(function(){
	    
    if(bailIfNotLoggedIn())
        return;
    
    //The up/down vote id(s) are in the form 'upvote(N)' or 'downvote(N)' where (N) is the 
    //id of the model object the user is voting on. This convention is followed for
    //points(N) and images so you'll see this type of replace in several places.
	var modelid = $(this).attr('id').replace("upvote","");
	changeVoteDisplay('up', modelid);
    vote("up", model, modelid);});
	
	$('.downvote').click(function(){
	    
        if(bailIfNotLoggedIn())
            return;
	        
		var modelid = $(this).attr('id').replace("downvote","");
        changeVoteDisplay('down', modelid);
        vote("down", model, modelid);});
});
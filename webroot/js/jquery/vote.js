String.prototype.trim = function () {
  return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1");
};

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
		    var modelid = $(this).attr('id').replace("upvote","");
		    changeVoteDisplay('up', modelid);
            vote("up", model, modelid);});
	
	$('.downvote').click(function(){
		var modelid = $(this).attr('id').replace("downvote","");
        changeVoteDisplay('down', modelid);
        vote("down", model, modelid);});
});
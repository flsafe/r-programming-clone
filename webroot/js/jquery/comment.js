commentdiv = '<div class=comment"></div><br/>';

function postComment(modelname, model_id, parent_id, commenttext){
    url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/";
    $.post(url, {text: commenttext});
}

function displayComment(commenttext){
    first      = $("#commentslist :first");
    newcomment = $(commentdiv); /*TODO: Form correct comment div*/
    newcomment.text(commenttext);
    first.before(newcomment);
}

function displayReply(replyingto, level, commenttext){
}

$(document).ready(function(){
	$("#newcommentform").submit(function(){

	    commenttext = $("#newcommentformtext").val();
	    $("#submitnewcommentformtext").val("");
	    modelname   = $("#modelname").val();
	    model_id    = $("#model_id").val();

	    postComment(modelname, model_id, 0, commenttext);
	    displayComment(commenttext);
	    
        return false;})
    
    $(".reply").click(function(){ /*TODO: use .submit for the reply forms*/
        meta = $(this).data("meta");
        postComment(meta.modelname, meta.model_id, meta.id, "New Reply");
        displayReply(meta.id, meta.level, "New Reply");
        return false;});
        
    return false;
    });


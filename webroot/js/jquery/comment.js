commentdiv = '<div class=comment"></div><br/>';

function postComment(modelname, model_id, parent_id, commenttext){
    url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/";
    $.post(url, {text: commenttext});
}

function displayComment(commenttext){
    first      = $("#commentslist :first");
    newcomment = $(commentdiv);
    newcomment.text(commenttext);
    first.before(newcomment);
}

function displayReply(replyingto, level, commenttext){
    parent = $("#comment"+replyingto);
    reply = $(commentdiv);
    reply.text(commenttext);
    parent.after(reply);
}

$(document).ready(function(){
	$("#submitcomment").click(function(){
	    
	    modelname   = $("#modelname").val(); /*TODO: YUCK, place this stuff in hidden fields*/
	    model_id    = $("#model_id").val();
	    commenttext = $("#commenttext").val();
	    $("#commenttext").val("");
	    
	    postComment(modelname, model_id, 0, commenttext);
	    displayComment(commenttext);
	    
        return false;})
    
    $(".reply").click(function(){
        meta = $(this).data("meta");
        postComment(meta.modelname, meta.model_id, meta.id, "New Reply");
        displayReply(meta.id, meta.level, "New Reply");
        return false;});
        
    return false;
    });


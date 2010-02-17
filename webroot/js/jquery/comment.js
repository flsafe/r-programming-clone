function postComment(modelname, model_id, comment_id, commenttext){
    
    alert(commenttext);
    
    url = "/comments/add/"+modelname+"/"+model_id+"/0/";
    $.post(url, {text: commenttext}, function(){});
}

$(document).ready(function(){
	$("#submitComment").click(function(){
	    
	    modelname   = $("#modelname").val();
	    model_id    = $("#model_id").val();
	    commenttext = $("#commentText").val();
	    postComment(modelname, model_id, 0, commenttext);
	    
        return false;
})});


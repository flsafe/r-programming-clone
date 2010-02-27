/*There is a convention here. A new top level comment is called just
  a 'comment' and its class is 'rootcomment'. A comment that is a reply 
  to another comment is called a 'reply'. This convention is reflected 
  in the class names and the id's in the xhtml.*/
  
commentdiv     = "<div class=\"rootcomment\"></div>";
commenttextdiv = "<div class=\"commenttext\"></div>";

function postComment(modelname, model_id, parent_id, commenttext){
    url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/";
    $.post(url, {text: commenttext});
}

function displayComment(commenttext){
    first      = $("#commentslist :first");
    newcomment = $(commentdiv); 
    text       = $(commenttextdiv);
    text.text(commenttext); /*Don't forget this escapes the text*/
    newcomment.append(text);

    first.before(newcomment);
}

function displayReply(replyingto, level, commenttext){
}

$(document).ready(function(){
	$("#newcommentform").submit(function(){

	    commenttext = $("#newcommentformtext").val();
	    $("#newcommentformtext").val("");
	    modelname   = $("#modelname").val();
	    model_id    = $("#model_id").val();

	    postComment(modelname, model_id, 0, commenttext);
	    displayComment(commenttext);
        return false;})
    
    $(".reply").click(function(){ /*TODO: use .submit for the reply forms*/
        return false;});
        
    return false;
    });


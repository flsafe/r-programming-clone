/*
Client side comment logic. Look at comments_builder.php to see where
all this html is generated.


There is a convention here. A new top level comment is called just
a 'comment' and its class is 'rootcomment'. A comment that is a reply 
to another comment is called a 'reply'. This convention is reflected 
in the class names and the id's in the xhtml.
*/
  
//Used to wrap new comments
commentdiv     = "<div class=\"rootcomment\"></div>";
commenttextdiv = "<div class=\"commenttext\"></div>";

function postComment(modelname, model_id, parent_id, commenttext){
    if(commenttext == "")
        return;
    url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/";
    $.post(url, {text: commenttext});
}

function postReply(thiselem){
    modelname      = $("#modelname").val();
	model_id       = $("#model_id").val();
	comment        = thiselem.parent();
	comment_id     = comment.find("[name=commentid]").val();
    replytext      = comment.find(".replyformtext").val();
    postComment(modelname, model_id, comment_id, replytext);
}

function displayComment(commenttext){
    first      = $("#commentslist :first");
    newcomment = $(commentdiv); 
    text       = $(commenttextdiv);
    text.text(commenttext); /*Don't forget this escapes the text*/
    newcomment.append(text);

    first.before(newcomment);
}

function displayReplyForm(thiselem){
    thiselem.after('<div><textarea class="replyformtext"></textarea></div><input type="submit" value="Reply"/>');
}

$(document).ready(function(){
	$("#newcommentform").submit(function(){
        
        if(bailIfNotLoggedIn())
            return false;
        
	    commenttext = $("#newcommentformtext").val();
	    $("#newcommentformtext").val("");
	    modelname   = $("#modelname").val();
	    model_id    = $("#model_id").val();

	    postComment(modelname, model_id, 0, commenttext);
	    displayComment(commenttext);
        return false;})
    
    $(".reply").click(function(){ /*TODO: use .submit for the reply forms*/
        displayReplyForm($(this))
        return false;});
        
    $(".replyform").submit(function(){
        postReply($(this));
        return false;});

    return false;
    });


/*
Client side comment logic. Look at comments_builder.php to see where
all this html is generated.


There is a convention here. A new top level comment is called just
a 'comment' and its class is 'rootcomment'. A comment that is a reply 
to another comment is called a 'reply'. This convention is reflected 
in the class names and the id's in the xhtml.
*/
  
//Used to wrap new comments
commentdiv      = "<div class=\"rootcomment\"></div>";
replydiv        = '<div class="childcomment"></div>';
commentmetaspan = '<span class="commentmeta">by $name just a moment ago</span>';
commenttextspan = "<span class=\"commenttext\"></span>";
replyform       = '<div><textarea class="replyformtext"></textarea></div><input type="submit" value="Reply"/>';

function postComment(modelname, model_id, parent_id, commenttext){
    if(commenttext == "")
        return;
    url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/";
    $.post(url, {text: commenttext});
}

function postReply(thiselem){
    modelname      = $("#modelname").val();
	model_id       = $("#model_id").val();
	parent        = thiselem.parent();
	
	comment_id     = parent.find("[name=commentid]").val();
    replytext      = parent.find(".replyformtext").val();
    
    postComment(modelname, model_id, comment_id, replytext);
    parent.find(".replyformtext").remove();
    parent.find("[type=submit]").remove();

    newcomment     = $(replydiv);
    text           = $(commenttextspan);
    //The html has a label with the name attribute set to the username
    newcomment.append(commentmetaspan.replace("$name", $('#loggedin').attr('name')) + "<br/>");
    text.text(replytext);
    newcomment.append(text);
    parent.find(".replyform").first().after(newcomment);
    
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
    thiselem.after(replyform);
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
    
    $(".reply").click(function(){
        displayReplyForm($(this))
        return false;});
        
    $(".replyform").submit(function(){
        postReply($(this));
        return false;});

    return false;
    });


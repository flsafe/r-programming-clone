/*
Client side comment logic. Look at comments_builder.php to see where
all this html is generated.


There is a convention here. A new top level comment is called 
a 'comment' and its class is 'rootcomment'. A comment that is a reply 
to another comment is called a 'reply'. This convention is reflected 
in the class names and the id's in the xhtml.
*/
  
//Used to wrap new comments
var commentdiv      = "<div class=\"rootcomment\"></div>";
var commentmetaspan = '<span class="commentmeta">by $name just a moment ago</span>';
var commenttextspan = "<span class=\"commenttext\"></span>";

var replyform       = '<div><textarea class="replyformtext"></textarea></div><input type="submit" value="Reply"/>';
var replydiv        = '<div class="childcomment"></div>';

function postComment(modelname, model_id, parent_id, commenttext){
    if(commenttext == "")
        return;
    var url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/";
    $.post(url, {text: commenttext});
}

function postReply(thiselem){
    var parent         = thiselem.parent();
    var modelname      = $("#modelname").val();
	var model_id       = $("#model_id").val();
	var comment_id     = parent.find("[name=commentid]").val();
    var replytext      = parent.find(".replyformtext").val();
    
    postComment(modelname, model_id, comment_id, replytext);
    parent.find(".replyformtext").remove();
    parent.find("[type=submit]").remove();

    displayReply(replydiv, commenttextspan, replytext, parent)
}

function displayReply(newcommentdiv, textspan, replytext, parentelem){
    if(replytext == "")
        return;
    var newcomment     = $(newcommentdiv);
    var text           = $(textspan);

    newcomment.append(commentmetaspan.replace("$name", $('#loggedin').attr('name')) + "<br/>");
    text.text(replytext);
    newcomment.append(text);
    parentelem.find(".replyform").first().after(newcomment); //Add to top of replies
}

function displayComment(commenttext){
    if(commenttext == "")
        return;
    var first      = $("#commentslist :first");
    var newcomment = $(commentdiv); 
    var text       = $(commenttextspan);
    
    newcomment.append(commentmetaspan.replace("$name", $('#loggedin').attr('name')) + "<br/>");
    text.text(commenttext); /*Don't forget this escapes the text*/
    newcomment.append(text);

    if(!first.length)
        $("#commentslist").append(newcomment);
    else
        first.before(newcomment);
}

function displayReplyForm(thiselem){
    if($.find('.replyformtext').length > 0)
        return;
        
    reply = $(replyform);
    reply.find(".replyformtext").first().focus();
    thiselem.after(replyform);
}

$(document).ready(function(){
	$("#newcommentform").submit(function(){
        
        if(bailIfNotLoggedIn())
            return false;
        
	    var commenttext = $("#newcommentformtext").val();
	    $("#newcommentformtext").val("");
	    var modelname   = $("#modelname").val();
	    var model_id    = $("#model_id").val();

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


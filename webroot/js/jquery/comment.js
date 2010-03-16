/*
Client side comment logic. Look at comments_builder.php to see where
all this html is generated.


There is a convention here. A new top level comment is called 
a 'comment' and its class is 'rootcomment'. A comment that is a reply 
to another comment is called a 'reply'. This convention is reflected 
in the class names and the id's in the xhtml.

#TODO: This got ugly really fast, I need to refactore this into something
       more understandable. I think an object oriented aproach would be easier to under stand.
*/
  
//Used to wrap new comments and replys
var commentdiv      = '<div class="rootcomment"><form class="replyform"></form></div>';
var commentmetaspan = '<span class="commentmeta">by $name just a moment ago</span> <span id="tag$number" class="commentmeta"> | saving...</span>';
var commenttextdiv  = '<div class="commenttext"></div>';

var replyform       = '<div><textarea class="replyformtext"></textarea></div><input type="submit" value="Comment"/><a class="formathelp" href="/pages/format_help">format help</a>';
var replydiv        = '<div class="childcomment"><form class="replyform"></form></div>';

//Used to parse user markdown
var markdown        = new Showdown.converter();

//Used to identify which 'saving...' status needs to be changed
//to the 'edit' link after the comment has been successfully commited to the db
var tagcounter = 0;

function nextTag(){
    return tagcounter += 1;
}

function fillOutMetadata(newcomment, tag){
    commentmetaspan = commentmetaspan.replace("$name", $('#loggedin').attr('name'));
    commentmetaspan = commentmetaspan.replace("$number", tag);
    newcomment.find(".replyform").append(commentmetaspan);
}

function fillOutCommentText(newcomment, replytext){
    textdiv = escapeAndMarkdown(replytext);
    newcomment.find(".replyform").append(textdiv);
}

function postComment(modelname, model_id, parent_id, commenttext, tag){
    if(commenttext == "")
        return;
        
    var url = "/comments/add/"+modelname+"/"+model_id+"/"+parent_id+"/"+tag;
    $.post(url, {text: commenttext},
        
        //Change the 'saving...' status to an 'edit' link
        function(data, textStatus, xmlHttpRequest){
            resp = JSON.parse(data);
            if(resp){
                $("#tag"+resp.tag).html(' | <a href="/comments/edit/'+resp.comment_id+'">edit</a>');

            }
        });
}

function postReply(thiselem, tag){
    var parent         = thiselem.parent();
    var modelname      = $("#modelname").val();
	var model_id       = $("#model_id").val();
	var comment_id     = parent.find("[name=commentid]").val();
    var replytext      = parent.find(".replyformtext").val();
    
    postComment(modelname, model_id, comment_id, replytext, tag);
    parent.find(".replyformtext").remove();
    parent.find("[type=submit]").remove();
    parent.find(".formathelp").remove();

    displayReply(replytext, parent, tag)
}

function displayReply(replytext, parentelem, tag){
    if(replytext == "")
        return;
        
    var newcomment = $(replydiv);

    fillOutMetadata(newcomment, tag);

    fillOutCommentText(newcomment, replytext);
    
    parentelem.find(".replyform").first().after(newcomment); //Add to top of replies
}

function displayComment(commenttext, tag){
    if(commenttext == "")
        return;
        
    var newcomment = $(commentdiv); 
   
    fillOutMetadata(newcomment, tag);
    fillOutCommentText(newcomment, commenttext);

    var firstcomment        = $("#commentslist :first");
    var postingFirstComment = !firstcomment.length;
    if(postingFirstComment)
        $("#commentslist").append(newcomment);
    else
        firstcomment.before(newcomment);
}

function displayReplyForm(thiselem){
    var replyFormAlreadyOpen = $.find('.replyformtext').length > 0;
    if(replyFormAlreadyOpen)
        return;
        
    reply = $(replyform);
    reply.find(".replyformtext").first().focus();
    thiselem.after(replyform);
}

function escapeAndMarkdown(commenttext){
    var text = $("<div/>"); /*Just a dummy jquery object used for escaping html*/
    text.text(commenttext); /*escapes html*/
    text     = markdown.makeHtml(text.html());
    textdiv  = $(commenttextdiv);
    textdiv.append($(text));
    return textdiv;
}

$(document).ready(function(){
	$("#newcommentform").submit(function(){
        if(bailIfNotLoggedIn())
            return false;
        
	    var commenttext = $("#newcommentformtext").val();
	    $("#newcommentformtext").val("");
	    var modelname   = $("#modelname").val();
	    var model_id    = $("#model_id").val();
        
        tag = nextTag();
	    postComment(modelname, model_id, 0, commenttext, tag);
	    displayComment(commenttext, tag);
        return false;})
        
    
    $(".reply").click(function(){
        displayReplyForm($(this))
        return false;});
        
        
    $(".replyform").submit(function(){
        tag = nextTag();
        postReply($(this), tag);
        return false;});

    return false;
    });


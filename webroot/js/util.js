/*
*Defines common functions and vars that are used in
*multiple .js files.
*/
var login   = '/users/add';


function bailIfNotLoggedIn(){
    if(! $('#loggedin').length){
        window.location = login;
        return true;
    }
    return false;
}
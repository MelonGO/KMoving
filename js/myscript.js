function getCookie(name){
    var arrstr = document.cookie.split(";");
    for(var i = 0;i < arrstr.length;i ++){
        var temp = arrstr[i].split("=");
        if(temp[0] == name)
            return unescape(temp[1]);
    }
    return null;
}

function clearErrorLogin(){
    document.getElementById("login-error").innerHTML = "";
}

function clearErrorRegister(){
    document.getElementById("register-error").innerHTML = "";
}

function show_token(token){
    document.getElementById("show-token").innerHTML = token;
}


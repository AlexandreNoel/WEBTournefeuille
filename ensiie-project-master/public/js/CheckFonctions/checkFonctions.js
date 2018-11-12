var checkFonction = (function(){
    function checkIfInteger(variable){
        return Number.isInteger(variable);
    }
    function checkIfString(variable){
        return variable.toString();
    }
    function checkIfIsdate(variable){
        var dateWrapper = new Date(variable);

    }

    function checkPassword(pass1,pass2){
        if(pass1!==pass2){
            return false;
        }else{
            return true;
        }
    }
    function checkEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    return {
        checkIfInteger:checkIfInteger,
        checkIfIsdate:checkIfIsdate,
        checkPassword:checkPassword,
        checkIfString:checkIfString,
        checkEmail:checkEmail
    }
}());
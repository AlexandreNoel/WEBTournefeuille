var authentification = (function(){
    function check(context){  
    $("#submitB").click(function(){
        var mail = $("#mail").val();
        var password = $("#password").val();
        $.post(
            "../user/php/user.php",
            {
                'mail':mail,
                'password':password
            },function(response){
           try{
            var turnJSON = JSON.parse(response);
               $("#body").html(" ");
               $("#bonjour").html("Hello " + turnJSON.name);
               $("#iduser").html("User id : "+ turnJSON.id);
               $.get(
                   "../views/accueil/accueil.html",function(html){
                       $("#body").html(html);
                   })
                $("#body").css("background-image","none");
                toastr.success('Welcome !');
                context.redirect("#/look");
           }catch(e){
            toastr.error('Unknown user !');
            $("#err").html(response);
            context.redirect("#/");
            window.location.reload();
           }
        }
    )
})
}
    return{
        check:check
    }

}());
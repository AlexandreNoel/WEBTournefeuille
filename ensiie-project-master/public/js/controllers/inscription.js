var inscription = (function(){
    function formAdd(context){
        $.get(
            "../views/inscription/inscription.html",function(html){
                $("#body").css("background-image","none");
                $("#body").html(" ");
                $("#body").html(html);
            }
        ).then(function(){
            var registration = formAddFisrtStep(context);
           
        })
    
    }

    function formAddFisrtStep(context){
        $("#register").click(function(){
            var lastName = $("#lastname").val();
            var name = $("#name").val();
            var mail = $("#email").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var confirm = $("#confirm").val();
            var checkLastName = checkFonction.checkIfString(lastName) ? true : $("#lastname").html("Error lastname");
            var checkname = checkFonction.checkIfString(name) ? true : $("#name").html("Error name") ;
            var checkmail = checkFonction.checkEmail(mail) ? true : $("#email").html("Error mail");
            var checkUsername = checkFonction.checkIfString(username) ? true : $("#username").html("Error username");
            var checkPassword = checkFonction.checkPassword(password,confirm)? true : $("#password").html("Error password") ;
            var genre = $("#genre").find("option:selected").val();

            if(checkLastName===true && checkname ===true && checkmail === true && checkUsername===true && checkPassword===true){
                $.post(
                    "../inscription/inscription/inscription.php",
                    {
                        'lastname':lastName,
                        'name':name,
                        'mail':mail,
                        'username':username,
                        'password':password,
                        'genre':genre
    
                    },function(response){
                      var response = response.toString().trim();
                      if(response==='Success'){
                        toastr.success('User registered !');
                        context.redirect("#/");
                        window.location.reload();
                       
                      }else{
                          console.log(response);
                          console.log("interieur")
                      toastr.error('User not registered. Check the inforamation !');
                      context.redirect("#/inscription");
                      window.location.reload();
                    
                      }
                    }
                )       
            }else{
                console.log("exterieur");
                toastr.error('You have to fill in the form!');
                context.redirect("#/inscription");
                return false;
            }
        })   
    }
return {
    formAdd:formAdd
}
}());
var consumed = (function(){
    function consume(context){
        $.get("../views/deleteFood/deleteFood.html",function(html){
            $("#datas").html(html);
        }).then(function(){
                    var nameOfUser = document.getElementById("bonjour").innerText;
                    nameOfUser=nameOfUser.substring(8,nameOfUser.length); 
                    $.post(
                        "../lookInFridge/lookInFridge.php",
                        { 
                            "nameOfUser":nameOfUser,
                        },function(dataS){ 
                            var m = 1223;
                            console.log(new Date(m));
                            var consumedJSON = JSON.parse(dataS);
                            var productsAvailable = consumedJSON.available;
                            productsAvailable = JSON.parse(productsAvailable);

                            $("#consumed").html(productsAvailable[0].count +" products in fridge");
                            var productsInFridge = JSON.parse(consumedJSON.datasFridge);
                            var products = productsInFridge;  
                            for(var k=0;k<products.length;k++){
                                $("#datas").append($("#productDelete").append("<option value="+products[k].idfood+">"+products[k].namef+", exp. date : "+products[k].expirationdate+", quantity : "+products[k].quantity+", code barre : "+ products[k].codebarre+"</option>"));
                               }
                        }
                    ).then(function(){
                        $("#btnDelete").click(function(){
                            var idF = $("#productDelete").find("option:selected").val();
                            var idParent = $("#iduser").text();
                            var idU = idParent.substring(9,idParent.length).trim();
                            $.post( 
                                "../consume/consume.php",
                                {
                                    "idfood":idF,
                                    "id":idU
                                },function(messageS){
                                    $("#temp").html(messageS);
                                    messageS = messageS.trim();
                                    if(messageS==='')
                                    {
                                        toastr.success('Product consumed !');
                                        context.redirect("#/look");
                                    }else{
                                        console.log(messageS);
                                        toastr.error('Product didn\'t consume !');
                                    }
                                }
                            )
                          
                        })
                    })
                } 
            )
        }
    return {
        consume:consume,
    }
}());
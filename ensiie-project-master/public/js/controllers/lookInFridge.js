var lookIn = (function(){
    function getPromise()
    {
        $("#contener123").fadeIn(2000); 
        $("#contener223").fadeIn(2000);
        
       return new Promise(function (resolve,reject){
            $.get(
                "../views/lookInFridge/lookInFridheBody.html",
                function (data) {
                    $("#datas").html(data);
                    var nameOfUser = $("#bonjour").text();
                    nameOfUser=nameOfUser.substring(8,nameOfUser.length); 
                    $.post(
                        "../lookInFridge/lookInFridge.php",
                        {
                            "nameOfUser":nameOfUser,
                        },function(dataS){
                            var consumedJSON = JSON.parse(dataS);
                            var availableProducts = JSON.parse(consumedJSON.available);
                            $("#consumed").html(availableProducts[0].count+" products in fridge");
                            var productsInFridge = JSON.parse(consumedJSON.datasFridge);
                            $("#tbody").html(" ");
                            $("#produitsDispo").html(productsInFridge.length+ " products in fridge");
                            for(var i=0;i<productsInFridge.length;i++){
                                $("#tbody").append("<tr>");
                                $("#tbody").append("<th scope='row'>"+productsInFridge[i].idfood+"</th>");
                                $("#tbody").append("<td>"+productsInFridge[i].namef+"</td>");
                                $("#tbody").append("<td>"+productsInFridge[i].typet+"</td>");
                                $("#tbody").append("<td>"+productsInFridge[i].price+"</td>");
                                $("#tbody").append("<td>"+productsInFridge[i].expirationdate+"</td>");
                                $("#tbody").append("<td>"+productsInFridge[i].quantity+"</td>");
                                $("#tbody").append("<td>"+productsInFridge[i].codebarre+"</td>");
                                $("#tbody").append("</tr>");
                            }
                        }
                    )
                }
            )
        })
    }
    function look(){
        var get = getPromise();      
    }
    return {
        look:look,
    }
})();
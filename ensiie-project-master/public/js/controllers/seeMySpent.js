var seeMySpent = (function(){
    function see(){
        $.get(
            "../views/seeMySpent/seeMySpent.html",function(html){
                $("#datas").html(html);
                $("#spent").html("Amount  : " );
                $("#waste").html("Number of products O");
            }
            )
        var idUser=$("#iduser").text();
        idUser=idUser.substring(9,idUser.length).trim(); 
       
        $.post(
            "../seeMySpent/seeMySpent.php",
            {
                'waste':"waste",
                'food':"food",
                'idUser':idUser
            },function(number){
             
                var datas = JSON.parse(number);
                $("#waste").html("Number of product : "+ datas.countWaste);
                $("#spent").html("You spent : "+datas.price.toString().substring(0,6)+" euros");
                var productsInFridge = datas.wasteProducts[0];
                var products = datas.wasteProducts;
                var consumed = datas.consumedProducts;
                for(var k=0;k<datas.wasteProducts.length;k++){
                 
                    $("#datas").append($("#wasteProduct12").append("<option value="+products[k].idfood+">"+products[k].namef+", exp. date : "+products[k].expirationdate+",price :"+products[k].price+"</option>"));
                   }
                   for(var k=0;k<consumed.length;k++){
                 
                    $("#datas").append($("#consumed123").append("<option value="+consumed[k].idfood+">"+consumed[k].namef+", exp. date : "+consumed[k].expirationdate+",price :"+consumed[k].price+"</option>"));
                   }
            }
            )
    }
    return{
        see:see
    }
}());
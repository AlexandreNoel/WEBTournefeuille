var addFood = (function(){
    String.prototype.sansAccent = function(){
        var accent = [
            /[\300-\306]/g, /[\340-\346]/g, // A, a
            /[\310-\313]/g, /[\350-\353]/g, // E, e
            /[\314-\317]/g, /[\354-\357]/g, // I, i
            /[\322-\330]/g, /[\362-\370]/g, // O, o
            /[\331-\334]/g, /[\371-\374]/g, // U, u
            /[\321]/g, /[\361]/g, // N, n
            /[\307]/g, /[\347]/g, // C, c
        ];
        var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
         
        var str = this;
        for(var i = 0; i < accent.length; i++){
            str = str.replace(accent[i], noaccent[i]);
        }
        return str;
    }
    function addAFood(context){
        var nameOfUser = $("#bienvenue").html();
        $.get("../views/addFood/addfood.html",function(html){
            $("#datas").html(html);
            $("#findProduct").click(function(){
                var codeBarre = $("#codeBarre11").val();
                $.post("../addFood/getAPIopenfoodFact/getApiopenFoodFact.php",{
                    codeBarre:codeBarre
                },function(response){
                    var response1 = response.trim();
                    if(response1===""){
                        $("#name1").val("Product was not found !");
                        toastr.error('Product not found ! Try again');
                    }else{
                
                        toastr.success('Product found !');
                        var nameOfproduct = $("#temp").html(response).fadeOut(0);
                        $("#name1").val(nameOfproduct.html());
                        $("#save1").click(function(){
                            var name1 = $("#name1").val().sansAccent();
                            var type1 = $("#type1").val();
                            var price1 = $("#price1").val();
                            var date1 = $("#date1").val();
                            var idParent = $("#iduser").text();
                            var quantity1 = $("#quantity1").val();
                            idParent = idParent.substring(9,idParent.length);
                            name1 = name1.sansAccent();
                            name1=name1.replace("'"," ");
                            name1 = name1.replace(",",".");
                            $.post("../addFood/php/addFood.php",{
                                name1:name1,
                                type1:type1,
                                price1:price1,
                                date1:date1,
                                codeBarre:codeBarre,
                                idParent:idParent,
                                quantity1:quantity1
                            },
                            function(response){
                                if(response==="Success"){
                                    toastr.success('Product added !');
                                    context.redirect("#/look");
                                }else{
                                $("#temp").html(response).fadeIn(0);
                                   console.log(response);
                                    toastr.error('There had a problem! Try it again, Please');
                                }
                            }
                            )
                        })
            
                    }
                   
                })
            })
        })
    }
    return {
        addAFood:addAFood,
    }
}());
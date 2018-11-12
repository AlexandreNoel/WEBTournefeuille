(function () {
    var sammy = Sammy('#body',function () {
      
        this.get("#/",authentification.check);
        this.get("#/look",lookIn.look);
        this.get("#/addFood",addFood.addAFood);  
        this.get("#/editFood",seeMySpent.see);
        this.get("#/consume",consumed.consume);
        this.get("#/inscription",inscription.formAdd);  
      
});  
        $(function () {
            sammy.run("#/");
        });        
        sammy.refresh();   
}());

$(document).ready(() => {
$.ajax({
    url: 'https://localhost:8080/user-disconnect.php'
}).done(function (res) {
    
    clearSession();
}).fail(function (error) {
    alert("Erreur");
});
});
// LOGIN PAGE
$('#entrar').click(function() {
    var username = $('#username').val();
    var password = $('#password').val();
    var type = "A";
    
    fetch("http://projetofinalweb/Back-end/api/read/login.php", { 
        method: "POST",
        body: JSON.stringify({ 
        username: username, 
        password: password
        }), 
        headers: { 
            "Content-type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        } 
    }) 
    .then(response => response.json())
    //.then(data => console.log(data))
    .then(
        function(data) {
            console.log(data.id);
            sessionStorage.setItem("id", data.id);
            sessionStorage.setItem("name", data.name);
            sessionStorage.setItem("surname", data.surname);
            sessionStorage.setItem("username", data.username)
            sessionStorage.setItem("type", data.type);
            window.location.href = "http://projetofinalweb/Front-end/index.html";
        }
    ); 
});
// HOME PAGE
/*
document.getElementById("id").innerHTML = sessionStorage.getItem("id");
document.getElementById("name").innerHTML = sessionStorage.getItem("name");
document.getElementById("surname").innerHTML = sessionStorage.getItem("surname");
document.getElementById("username").innerHTML = sessionStorage.getItem("username");
document.getElementById("type").innerHTML = sessionStorage.getItem("type");
*/

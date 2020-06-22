// LOGIN PAGE
$('#entrar').click(function() {
    var username = $('#username').val();
    var password = $('#password').val();
    
    fetch("http://projetofinalweb/Back-end/login", { 
        method: "POST",
        body: JSON.stringify({
        oper: "login",
        username: username, 
        password: password
        }), 
        headers: { 
            "Content-type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        } 
    }) 
    .then(response => response.json())
    .then(
        function(data) {
            console.log(data[0].status);
            if (data[0].check == "ok") {
                document.getElementById("username").classList.remove('is-invalid');
                document.getElementById("username").classList.add('is-valid');
                if (data[0].status == true) {
                    document.getElementById("password").classList.remove('is-invalid');
                    document.getElementById("password").classList.add('is-valid');
                    sessionStorage.setItem("id", data[0].id);
                    sessionStorage.setItem("name", data[0].name);
                    sessionStorage.setItem("surname", data[0].surname);
                    sessionStorage.setItem("username", data[0].username);
                    sessionStorage.setItem("type", data[0].type);
                    console.log(data[0].id);
                    window.location.href = "http://projetofinalweb/Front-end/index.html";
                } else {
                    document.getElementById("password").classList.remove('is-valid');
                    document.getElementById("password").classList.add('is-invalid');
                }
            } else {
                document.getElementById("username").classList.add('is-invalid');
            }    
        }
    ); 
});

// NAVBAR
document.getElementById("userinfo").innerHTML="" + sessionStorage.getItem("name") + " " + sessionStorage.getItem("surname");

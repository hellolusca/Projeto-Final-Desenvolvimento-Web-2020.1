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
    .then(data => console.log(data))
    .then(json => function(json) {
    sessionStorage.setItem("ID", json.id);
    sessionStorage.setItem("Nome", json.name);
    sessionStorage.setItem("Sobrenome", json.surname);
    sessionStorage.setItem("Tipo", json.type);
    window.location.href = "http:projetofinalweb/Front-end";
    })
});

if (sessionStorage.getItem("id") == null) {
    window.location.href = "http://projetofinalweb/"
}

//NAVBAR
document.getElementById("userinfo").innerHTML="" + sessionStorage.getItem("name") + " " + sessionStorage.getItem("surname");

// DashCount Funcionários
fetch("http://projetofinalweb/Back-end/employees", { 
        method: "POST",
        body: JSON.stringify({
        oper: "count"
        }), 
        headers: { 
            "Content-type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        } 
    }) 
    .then(response => response.json())
    .then(
        function(data) {
            if (data > 0) {
                var i = 1;                  
                function myLoop() {         
                setTimeout(function() {   
                    document.getElementById("funccard").innerHTML=i;
                    i++;                   
                    if (i <= data) {           
                        myLoop();             
                    }
                }, 8)
            }
            myLoop();
            } else {
                document.getElementById("funccard").innerHTML=0;
            }  
        }
    );

// DashCount Fornecedores
fetch("http://projetofinalweb/Back-end/providers", { 
        method: "POST",
        body: JSON.stringify({
        oper: "count"
        }), 
        headers: { 
            "Content-type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        } 
    }) 
    .then(response => response.json())
    .then(
        function(data) {
            if (data > 0) {             
                var i = 1;                  
                function myLoop() {         
                setTimeout(function() {   
                    document.getElementById("forncard").innerHTML=i;
                    i++;                   
                    if (i <= data) {           
                        myLoop();             
                    }
                }, 8)
            }
            myLoop();
            } else {
                document.getElementById("forncard").innerHTML=0;
            }  
        }
    );

// DashCount Produtos
fetch("http://projetofinalweb/Back-end/products", { 
        method: "POST",
        body: JSON.stringify({
        oper: "count"
        }), 
        headers: { 
            "Content-type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        } 
    }) 
    .then(response => response.json())
    .then(
        function(data) {
            if (data > 0) {             
                var i = 1;                  
                function myLoop() {         
                setTimeout(function() {   
                    document.getElementById("prodcard").innerHTML=i;
                    i++;                   
                    if (i <= data) {           
                        myLoop();             
                    }
                }, 8)
            }
            myLoop();
            } else {
                document.getElementById("prodcard").innerHTML=0;
            }  
        }
    );

// DashCount Ativos
fetch("http://projetofinalweb/Back-end/assets", { 
    method: "POST",
    body: JSON.stringify({
    oper: "count"
    }), 
    headers: { 
        "Content-type": "application/json; charset=UTF-8",
        "Accept": "application/json"
    } 
}) 
.then(response => response.json())
.then(
    function(data) {
        if (data > 0) {             
            var i = 1;                  
            function myLoop() {         
            setTimeout(function() {   
                document.getElementById("ativcard").innerHTML=i;
                i++;                   
                if (i <= data) {           
                    myLoop();             
                }
            }, 8)
        }
        myLoop();
        } else {
            document.getElementById("ativcard").innerHTML=0;
        }  
    }
);
if (sessionStorage.getItem("id") == null) {
    window.location.href = "http://projetofinalweb/"
}

function logout() {
    sessionStorage.removeItem("id")
    window.location.href = "http://projetofinalweb";
}

//NAVBAR
document.getElementById("userinfo").innerHTML="" + sessionStorage.getItem("name") + " " + sessionStorage.getItem("surname");

//Feedbacks
$("#feedbackPositivo").hide();
$("#feedbackNegativo").hide();
$('#submit').click(function() {
    var name = $('#name').val();
    var surname = $('#surname').val();
    var cpf = $('#cpf').val();
    var age = Number($('#age').val());
    var cellphone = $('#cellphone').val();
    var email = $('#email').val();
    var salary = Number($('#salary').val());
    var job_title = $('#job_title').val();;

    if (name != "" &&
        surname != "" &&
        cpf != "" &&
        age != 0 &&
        cellphone != "" &&
        email != "" &&
        salary != 0 &&
        job_title != 0) {
            var body = JSON.stringify({
                oper: "insert",
                name: name,
                surname: surname,
                cpf: cpf,
                age: age,
                cellphone: cellphone,
                email: email,
                salary: salary,
                job_title_id: job_title
            })
            console.log(body);
            
            fetch("http://projetofinalweb/Back-end/employees", { 
                method: "POST",
                body: body, 
                headers: { 
                    "Content-type": "application/json; charset=UTF-8",
                    "Accept": "application/json"
                } 
            }) 
            .then(response => response.json())
            .then(function(result) {
                $("#feedbackNegativo").hide();
                $("#feedbackPositivo").show();
                setTimeout(function() { 
                    $("#feedbackPositivo").hide();
                }, 3000)
            })
        } else {
            $("#feedbackPositivo").hide();
            $("#feedbackNegativo").show();
            setTimeout(function() { 
                $("#feedbackNegativo").hide();
            }, 3000)
        }
})    

//Select Create
jobsSelect = document.getElementById("job_title");
fetch("http://projetofinalweb/Back-end/employees", { 
        method: "POST",
        body: JSON.stringify({
            oper: "jobs"
        }),
        headers: { 
            "Content-type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        } 
    }) 
    .then(response => response.json())
    .then(function(result) {
        result.forEach(element => {
            option = new Option(element.name, element.id)
            jobsSelect.options[jobsSelect.options.length] = option
        });    
    })
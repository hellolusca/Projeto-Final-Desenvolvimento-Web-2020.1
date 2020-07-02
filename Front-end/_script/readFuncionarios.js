if (sessionStorage.getItem("id") == null) {
    window.location.href = "http://projetofinalweb/"
}

function logout() {
    sessionStorage.removeItem("id")
    window.location.href = "http://projetofinalweb";
}

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

$( document ).ready(function() {
    //NAVBAR
    document.getElementById("userinfo").innerHTML="" + sessionStorage.getItem("name") + " " + sessionStorage.getItem("surname");

    $("#feedbackPositivo").hide();
    $("#feedbackNegativo").hide();

    //Preencher tabela
    function list() {
        return fetch(`http://projetofinalweb/Back-end/employees`)
        .then((response) => {
            return response.json()
        })
        .then(json => {
            return json
        })
        .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
    }

    (async function() {
        let data = await list()
        let [rep1, rep2, ...repRest] = data
        addTwoRows(data)
    })();

    let addTwoRows = (rows) => {
        rows.forEach(e => {
        let tbody = document.querySelector('#listaDeFuncionarios tbody')
        let tr = document.createElement('tr')
        tr.id = "linha"+e.id;
        tr.onclick = "listFunc("+e.id+")";
        tr.innerHTML = rowHtml(e)
        tbody.appendChild(tr)
        })
    }

    let rowHtml = row => {
        html = ''
        html += `<td><a href="edit.html?id=${row.id}">${row.id}</a></td><td>${row.name}</td><td>${row.surname}</td><td>${row.cpf}</td><td>${row.email}</td><td>${row.cellphone}</td><td><button class="btn btn-secondary my-2 my-sm-0" type="button" value="${row.id}" onclick="listFunc(${row.id})">&#128712;</button><button class="btn btn-primary my-2 my-sm-0" type="button" value="${row.id}" onclick="editFunc(${row.id})">&#9998;</button><button class="btn btn-danger my-2 my-sm-0" type="button" value="${row.id}" onclick="deleteFunc(${row.id}, '${row.name}', '${row.surname}')">&#128465;</button></td>`
        return html
    }

});

$("#filterButton").click(function () {
    $("#corpoTabela").empty();
    function list() {
        return fetch(`http://projetofinalweb/Back-end/employees`, {
            method: "POST",
            body: JSON.stringify({
                "oper": "filter",
                "filter_by": $("#filter_by").val(),
                "keyword": $("#keyword").val()
            }), 
            headers: { 
                "Content-type": "application/json; charset=UTF-8",
                "Accept": "application/json"
            }
        })
          .then((response) => {
            return response.json()
          })
          .then(json => {
            return json
          })
          .catch((err) => {
            console.log('Fetch Error :-S', err);
          });
    }
    
    (async function() {
        let data = await list()
        let [rep1, rep2, ...repRest] = data
        addRows(data)
      })();
    
    let addRows = (rows) => {
        rows.forEach(e => {
          let tbody = document.querySelector('#listaDeFuncionarios tbody')
          let tr = document.createElement('tr');
          tr.id = "linha"+e.id;
          tr.innerHTML = rowHtml(e)
          tbody.appendChild(tr)
        })
      }
    
    let rowHtml = row => {
        html = ''
        html += `<td><a href="edit.html?id=${row.id}">${row.id}</a></td><td>${row.name}</td><td>${row.surname}</td><td>${row.cpf}</td><td>${row.email}</td><td>${row.cellphone}</td><td><button class="btn btn-secondary my-2 my-sm-0" type="button" value="${row.id}" onclick="listFunc(${row.id})">&#128712;</button><button class="btn btn-primary my-2 my-sm-0" type="button" value="${row.id}" onclick="editFunc(${row.id})">&#9998;</button><button class="btn btn-danger my-2 my-sm-0" type="button" value="${row.id}" onclick="deleteFunc(${row.id}, '${row.name}', '${row.surname}')">&#128465;</button></td>`
        return html
    }
})

function listFunc(id) {
    fetch(`http://projetofinalweb/Back-end/employees/${id}`)
        .then((response) => {
            return response.json()
        })
        .then(resposta => {
            document.getElementById('idList').innerHTML = "ID do Funcionário: "+resposta.id;
            document.getElementById('nameList').innerHTML = "Nome: "+resposta.name;
            document.getElementById('surnameList').innerHTML = "Sobrenome: "+resposta.surname;
            document.getElementById('cpfList').innerHTML = "CPF: "+resposta.cpf;
            document.getElementById('ageList').innerHTML = "Idade: "+resposta.age;
            document.getElementById('cellphoneList').innerHTML = "Telefone: "+resposta.cellphone;
            document.getElementById('emailList').innerHTML = "Email: "+resposta.email;
            document.getElementById('salaryList').innerHTML = "Salário: "+resposta.salary;
        })
        .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
    $("#modalList").modal();
}

function editFunc(id) {
    var name, surname, cpf, age, cellphone, email, salary, job_title;
    fetch(`http://projetofinalweb/Back-end/employees/${id}`)
        .then((response) => {
            return response.json()
        })
        .then(resposta => {
            $('#id').val(id);
            $('#name').val(resposta.name);
            $('#surname').val(resposta.surname);
            $('#cpf').val(resposta.cpf);
            $('#age').val(resposta.age);
            $('#cellphone').val(resposta.cellphone);
            $('#email').val(resposta.email);
            $('#salary').val(resposta.salary);
            $('#job_title').val(resposta.job_title_id);
        })
        .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
    $("#modalEdit").modal();
}

$("#save").click(function() {
    id = $('#id').val();
    name = $('#name').val();
    surname = $('#surname').val();
    cpf = $('#cpf').val();
    age = Number($('#age').val());
    cellphone = $('#cellphone').val();
    email = $('#email').val();
    salary = Number($('#salary').val());
    job_title = $('#job_title').val();    

if (name != "" &&
    surname != "" &&
    cpf != "" &&
    age != 0 &&
    cellphone != "" &&
    email != "" &&
    salary != 0 &&
    job_title != 0) {
        var body = JSON.stringify({
            oper: "update",
            id: id,
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
                document.location.reload(true);
            }, 2000)
        })
    } else {
        $("#feedbackPositivo").hide();
        $("#feedbackNegativo").show();
        setTimeout(function() { 
            $("#feedbackNegativo").hide();
        }, 3000)
    }
})

function deleteFunc(id=null, name="", surname="") {
    var result = confirm(`Tem certeza que deseja excluir o funcionário `+name+ ` `+surname+`?`);
    if (result) {
        fetch(`http://projetofinalweb/Back-end/employees`, {
            method: "POST",
            body: JSON.stringify({
                "oper": "delete",
                "id": id,
            }), 
            headers: { 
                "Content-type": "application/json; charset=UTF-8",
                "Accept": "application/json"
            }
        })
          .then((response) => {
            return response.json()
            console.log(response[0]);
          })
          .catch((err) => {
            console.log('Fetch Error :-S', err);
        });
        $(`#linha${id}`).remove();
        alert("Excluído com sucesso!")
    }
}

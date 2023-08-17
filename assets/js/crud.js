function showPassword(input, button) {
    var password = document.getElementById(input);
    var showPasswordButton = document.getElementById(button);

    if (password.type === "password") {
        password.type = "text";
        showPasswordButton.innerHTML = '<img src="../assets/icons/invisible.png" alt="" class="icon">';
    } else {
        password.type = "password";
        showPasswordButton.innerHTML = '<img src="../assets/icons/visible.png" alt="" class="icon">';
    }
}

function openModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "block";
    modal.style.display = "flex";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
}

function closeModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "none";
}

function create(object, id_form) {
    const modal = document.getElementById("modal");
    console.log("ENTRO A LA FUNCION CREATE");
    var url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.create';
    var form_data = JSON.parse(formJSON(id_form));

    if (form_data.image) {
        form_data.image = form_data.image.replace(/^.*[\\\/]/, '');
    }

    var data = JSON.stringify({
        "object": object,
        "data": form_data
    });

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: data
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
            if (response.status == "OK") {
                window.parent.alertMessage("success", "¡Buen trabajo!", response.message);
                modal.style.display = "none";
            } else {
                window.parent.alertMessage("error", "¡Lo sentimos!", response.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.parent.alertMessage("error", "¡Lo sentimos!", error);
        });

    return false;
}

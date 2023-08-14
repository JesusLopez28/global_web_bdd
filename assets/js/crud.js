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

function formJSON(id_form) {
    var obj = {};
    var form = document.getElementById(id_form);
    var formElements = form.querySelectorAll("input:not([type=button]), textarea, select");

    formElements.forEach(function (element) {
        var name = element.name;
        var value = element.value;
        obj[name] = value;
    });

    return JSON.stringify(obj);
}

function alertMessage(icon, title, text, footer_text = "") {
    const dialog = document.createElement('div');
    dialog.className = 'custom-alert';
    dialog.innerHTML = `
      <div class="icon">${getIcon(icon)}</div>
      <div class="title">${title}</div>
      <div class="text">${text}</div>
      <div class="footer">${footer_text}</div>
    `;

    document.body.appendChild(dialog);

    setTimeout(function () {
        document.body.removeChild(dialog);
    }, 1500);
}

function getIcon(icon) {
    switch (icon) {
        case 'success':
            return '✔️';
        case 'error':
            return '❌';
        case 'warning':
            return '⚠️';
        default:
            return 'ℹ️';
    }
}

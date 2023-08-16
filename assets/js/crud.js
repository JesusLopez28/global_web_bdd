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
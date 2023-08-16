var token = sessionStorage.token;

if (token) {
    fetch('http://127.0.0.1/controllers/redirect.php?endpoint=user.getMenu', {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "object": {}
        })
    })
        .then(response => response.json())
        .then(menu => {
            var homeItem = menu.find(item => item.text === "Home");

            if (homeItem) {
                var validPaths = ['/index.php', '/views/login.php', '/views/register.php', '/'];
                if (validPaths.includes(window.location.pathname)) {
                    window.location.href = '/views/' + homeItem.location;
                } else {
                    var html = '';
                    for (var i = 0; i < menu.length; i++) {
                        if (menu[i].text === "Salir") {
                            html += `
                            <a href="${menu[i].location}">
                            <div class="option" onclick="sessionDestroy()">
                            <img src="${menu[i].img}" alt="${menu[i].text}">
                                    <h4>${menu[i].text}</h4>
                                </div>
                            </a>
                        `;
                        } else {
                            html += `
                            <a href="${menu[i].location}">
                                <div class="option">
                                    <img src="${menu[i].img}" alt="${menu[i].text}">
                                    <h4>${menu[i].text}</h4>
                                </div>
                            </a>
                        `;
                        }
                    }
                    document.getElementById("main_menu").innerHTML = html;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function sessionDestroy() {
    sessionStorage.clear();
    console.log("SESION VENCIDA");
    window.location.href = '/index.php';
}

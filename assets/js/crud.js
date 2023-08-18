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


var fields_object = [];

function getCrud(object, condition = "true", admin = "false") {
    const url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.getInfo';

    const requestData = {
        object: object
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(requestData)
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
            var tr_headers = document.querySelector("#table_crud #tr-headers");
            tr_headers.innerHTML = "";
            if (object != 'orders') {
                tr_headers.innerHTML = "<th>Acción</th>";
            }
            for (var i = 0; i < response.data.length; i++) {
                var element = response.data[i];
                tr_headers.innerHTML += "<th>" + element.label + "</th>";
                fields_object.push(element.field);
            }

            primary_key = response.primary;
            getRows(object, condition, 0, admin);
            getPagination(object);
        })
        .catch(error => {
            console.error('Error fetching object info:', error);
            const tbody = document.querySelector("#table_crud tbody");
            const tr = document.createElement("tr");
            tbody.appendChild(tr);
        });
}

function getPagination(object, currentPage = 0) {
    const url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.count';

    const requestData = {
        object: object,
        where: "true"
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(requestData)
    })
        .then(response => response.json())
        .then(response => {
            if (response.status === "OK") {
                const paginationRows = document.querySelector(".pagination_rows");
                paginationRows.innerHTML = "Cantidad de registros: " + response.total_rows;

                const pagination = document.querySelector(".pagination");
                pagination.innerHTML = "";

                const totalPages = parseInt(response.total_pages);

                if (totalPages > 0) {
                    pagination.innerHTML += '<li class="page-item" id="prevButton"><a class="page-link" href="#" onclick="paginate(\'' + object + '\', ' + (currentPage - 1) + ');">Anterior</a></li>';

                    for (let index = 1; index <= totalPages; index++) {
                        if (index === currentPage + 1) {
                            pagination.innerHTML += "<li class='page-item active'><a class='page-link' href='#'>" + index + "</a></li>";
                        } else {
                            pagination.innerHTML += "<li class='page-item'><a class='page-link' href='#' onclick='paginate(\"" + object + "\", " + (index - 1) + ");'>" + index + "</a></li>";
                        }
                    }

                    pagination.innerHTML += '<li class="page-item" id="nextButton"><a class="page-link" href="#" onclick="paginate(\'' + object + '\', ' + (currentPage + 1) + ');">Siguiente</a></li>';
                }
            } else {
                const paginationRows = document.querySelector(".pagination_rows");
                paginationRows.innerHTML = "Sin Registros";

                const pagination = document.querySelector(".pagination");
                pagination.innerHTML = "";
            }
        })
        .catch(error => {
            console.error('Error fetching pagination data:', error);
            const paginationRows = document.querySelector(".pagination_rows");
            paginationRows.innerHTML = "Sin Registros";

            const pagination = document.querySelector(".pagination");
            pagination.innerHTML = "";
        });
}

function paginate(object, page) {
    if (page >= 0) {
        getRows(object, "true", page);
        getPagination(object, page);
        changeActive(page);
    }
}

function changeActive(id) {
    const paginationItems = document.querySelectorAll(".pagination li");
    paginationItems.forEach(item => {
        item.classList.remove("active");
    });

    const activeLink = document.querySelector(".pagination li a[data-page='" + (id + 1) + "']");
    if (activeLink) {
        activeLink.parentNode.classList.add("active");
    }
}

function getRows(object, condition, page, admin = "false") {
    var where_condition = "";
    if (admin === "false" && (object === "orders" || object === "shopping_cart")) {
        var userIdCondition = "user_id = " + sessionStorage.userId;

        if (where_condition === "") {
            where_condition = userIdCondition;
        } else {
            where_condition = "(" + where_condition + ") AND " + userIdCondition;
        }
    } else {
        if (condition !== "true") {
            fields_object.forEach(function (field) {
                if (field !== "id") {
                    where_condition += field + " like '%" + condition + "%' or ";
                }
            });

            where_condition = where_condition.substring(0, where_condition.length - 3);
        } else {
            where_condition = condition;
        }
    }

    var requestData = {
        "object": object,
        "fields": "*",
        "where": "(" + where_condition + ")",
        "page": page,
        "order": "order by id asc"
    };

    fetch('http://127.0.0.1/controllers/redirect.php?endpoint=object.getRows', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(requestData)
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (response) {
            console.log("RESPUESTA GET ROWS: ");
            console.log(response);
            var tableBody = document.querySelector("#table_crud tbody");
            tableBody.innerHTML = "";

            if (response.length === 0) {
                var noFoundRow = document.createElement("tr");
                var noFoundCell = document.createElement("td");
                var noFoundMessage = document.createElement("h1");

                noFoundMessage.textContent = "Ups... No se encontraron registros";
                noFoundCell.appendChild(noFoundMessage);
                noFoundRow.appendChild(noFoundCell);

                tableBody.appendChild(noFoundRow);
            } else {

                response.forEach(function (value) {
                    var condition = primary_key + " = \\\"" + value[primary_key] + "\\\"";
                    var content_edit_action = '<button class="custom-button edit-button" onclick=\'openFormEditor("' + object + '", "' + primary_key + '", "' + value[primary_key] + '")\'>Editar</button>';
                    var content_trash_action = '<button class="custom-button delete-button" onclick=\'trash("' + object + '", "' + condition + '", this)\'>Borrar</button>';

                    if (object != 'orders') {
                        var row = "<tr>" + "<td>" + content_edit_action + content_trash_action + "</td>";
                    } else {
                        var row = "<tr>";
                    }
                    Object.keys(value).forEach(function (key) {
                        row += "<td>" + value[key] + "</td>";
                    });

                    row += "</tr>";
                    tableBody.innerHTML += row;
                });
            }
        })
        .catch(function (error) {
            console.error('Error fetching rows data:', error);
            var tableBody = document.querySelector("#table_crud tbody");
            tableBody.innerHTML = "<tr></tr>";
        });
}

function trash(object, condition, el) {
    alertMessage("warning", "¿Desea eliminar?", "Se eliminará de forma permanente.", "Si, ¡Eliminar!", "No", true, function (result) {
        if (result) {
            const request = {
                "object": object,
                "where": condition
            };

            fetch('http://127.0.0.1/controllers/redirect.php?endpoint=object.delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + sessionStorage.token
                },
                body: JSON.stringify(request)
            })
                .then(response => response.json())
                .then(response => {
                    if (response.status === "OK") {
                        el.parentNode.parentNode.remove();
                        alertMessage("success", "¡Buen trabajo!", response.message);
                    } else {
                        alertMessage("error", "¡Lo sentimos!", response.message);
                    }
                })
                .catch(error => {
                    alertMessage("error", "Error 505", error.message, "Error fatal.");
                });
        }
    });
}

function openFormEditor(object, condition, value) {
    const modal = document.getElementById("modal");
    console.log("LLEGO AL EDITOR");
    var where = condition + " = '" + value + "'";
    var data = JSON.stringify({
        "object": object,
        "fields": "*",
        "where": where,
        "page": 0,
        "order": ""
    });
    console.log("------- REQUEST FORM EDIT ------> ");
    console.log(data);

    modal.style.display = "block";
    modal.style.display = "flex";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";

    fetch('http://127.0.0.1/controllers/redirect.php?endpoint=object.getRows', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: data
    })
        .then(response => response.json())
        .then(response => {
            console.log("RESPUESTA DE EDICIION");
            console.log(response);
            var data = response[0];

            const form = document.getElementById("form");
            const updateButton = document.createElement("button");
            updateButton.textContent = "Actualizar";
            updateButton.classList.add("button");
            updateButton.onclick = function () {
                update(object, "form", condition, value);
                form.onsubmit = null;
                return false;
            };

            const addButton = form.querySelector("button[type='submit']");
            addButton.style.display = "none";

            form.insertBefore(updateButton, addButton);

            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = data[key];
                    }
                }
            }
        })
        .catch(error => {
            console.log(error);
        });
}

function update(object, id_form, condition, value) {
    console.log("***** ENTRO AL UPDATE *****");
    console.log(condition);
    var where = condition + " = '" + value + "'";
    var form_data = JSON.parse(formJSON(id_form));
    var data = JSON.stringify({
        "object": object,
        "data": form_data,
        "where": where
    });
    console.log("---------- REQUEST UPDATE ----------->");
    console.log(data);

    fetch('http://127.0.0.1/controllers/redirect.php?endpoint=object.update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: data
    })
        .then(response => response.json())
        .then(response => {
            console.log("RESPUESTA DE UPDATE");
            console.log(response);
            if (response.status == "OK") {
                document.querySelector(id_form).reset();
                const modal = window.parent.document.querySelector(".modal");
                modal.style.display = 'none';
                alertMessage("success", "¡Buen trabajo!", response.message);
            } else {
                alertMessage("error", "¡Lo sentimos!", response.message);
            }
        })
        .catch(error => {
            alertMessage("error", "Error 505", error.message, "Error fatal.");
        });
    return false;
}

var product_object = [];

function getProducts(object, condition = "true") {
    const url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.getInfo';

    const requestData = {
        object: object
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(requestData)
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);

            for (var i = 0; i < response.data.length; i++) {
                var element = response.data[i];
                product_object.push(element.field);
            }

            displayProducts(object, condition, 0);
        })
        .catch(error => {
            console.error('Error fetching object info:', error);
        });
}

function displayProducts(object, condition, page) {
    var where_condition = "";
    if (condition !== "true") {
        product_object.forEach(function (field) {
            if (field !== "id") {
                where_condition += field + " like '%" + condition + "%' or ";
            }
        });

        where_condition = where_condition.substring(0, where_condition.length - 3);
    } else {
        where_condition = condition;
    }

    var requestData = {
        "object": object,
        "fields": "*",
        "where": "(" + where_condition + ")",
        "page": page,
        "order": "order by id asc"
    };

    fetch('http://127.0.0.1/controllers/redirect.php?endpoint=object.getRows', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(requestData)
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (response) {
            console.log("RESPUESTA GET ROWS: ");
            console.log(response);
            var articlesContainer = document.getElementById("articles");
            articlesContainer.innerHTML = "";
            if (response.length === 0) {
                var noProductFound = document.createElement("h1");
                noProductFound.textContent = "Ups... No se encontró el producto";
                articlesContainer.appendChild(noProductFound);
            } else {
                response.forEach(function (value) {
                    var article = document.createElement("div");
                    article.className = "box__article";

                    var imageContainer = document.createElement("div");
                    imageContainer.className = "image-container";

                    var image = document.createElement("img");
                    image.src = "../assets/images/products/" + value.image;
                    image.alt = value.name;

                    var productName = document.createElement("h4");
                    productName.textContent = value.name;

                    var price = document.createElement("p");
                    price.textContent = "Precio: $" + value.price.toLocaleString('es-MX');

                    var category = document.createElement("p");
                    category.textContent = "ID: " + value.id;

                    var stock = document.createElement("p");
                    stock.textContent = "Stock: " + value.stock;

                    var quantityContainer = document.createElement("div");
                    quantityContainer.className = "quantity-container";

                    var quantityInput = document.createElement("input");
                    quantityInput.type = "number";
                    quantityInput.min = "1";
                    quantityInput.value = "1";
                    quantityInput.placeholder = "Cantidad";
                    quantityInput.className = "quantity-input";

                    var decreaseButton = document.createElement("button");
                    decreaseButton.textContent = "-";
                    decreaseButton.classList.add("quantity-button");
                    decreaseButton.onclick = function () {
                        if (parseInt(quantityInput.value) > 1) {
                            quantityInput.value = parseInt(quantityInput.value) - 1;
                        }
                    };

                    var increaseButton = document.createElement("button");
                    increaseButton.textContent = "+";
                    increaseButton.classList.add("quantity-button");
                    increaseButton.onclick = function () {
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                    };

                    var addToCartButton = document.createElement("button");
                    addToCartButton.textContent = "Agregar al carrito";
                    addToCartButton.classList.add("button");
                    addToCartButton.onclick = function () {
                        addToCart(value, quantityInput);
                    };

                    imageContainer.appendChild(image);
                    article.appendChild(imageContainer);
                    article.appendChild(productName);
                    article.appendChild(price);
                    article.appendChild(category);
                    article.appendChild(stock);

                    quantityContainer.appendChild(decreaseButton);
                    quantityContainer.appendChild(quantityInput);
                    quantityContainer.appendChild(increaseButton);
                    quantityContainer.appendChild(increaseButton);

                    article.appendChild(quantityContainer);
                    article.appendChild(addToCartButton);

                    articlesContainer.appendChild(article);
                });
            }
        })
        .catch(function (error) {
            console.error('Error fetching rows data:', error);
            var articlesContainer = document.getElementById("articles");
            articlesContainer.innerHTML = "";
        });
}

function addToCart(product, quantityInput) {
    console.log("ENTRO A LA FUNCION ADD TO CART");
    var url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.create';

    var cartData = {
        "object": "shopping_cart",
        "data": {
            "user_id": sessionStorage.userId,
            "product_id": product.id,
            "quantity": parseInt(quantityInput.value),
            "subtotal": product.price * parseInt(quantityInput.value)
        }
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(cartData)
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
            if (response.status == "OK") {
                window.parent.alertMessage("success", "¡Producto agregado al carrito!", response.message);
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

function updateQuantity(object, id_form) {
    const modal = document.getElementById("modal");
    console.log("ENTRO A LA FUNCION UPDATE QUANTITY");
    var url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.update';

    var form_data = JSON.parse(formJSON(id_form));

    var data = JSON.stringify({
        "object": object,
        "data": form_data,
        "where": "product_id = " + form_data.product_id
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
                window.parent.alertMessage("success", "¡Cantidad actualizada en el carrito!", response.message);
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

function order() {
    const url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.order';

    fetch(url, {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "object": {},
            "data": {}
        })
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
            if (response.status == "OK") {
                window.parent.alertMessage("success", "¡Orden realizada!", response.message);
            } else {
                window.parent.alertMessage("error", "¡Lo sentimos!", response.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.parent.alertMessage("error", "¡Lo sentimos!", error);
        });
}

function getCartProducts() {
    const url = 'http://127.0.0.1/controllers/redirect.php?endpoint=object.getCartProducts';

    const requestData = {
        "object": {},
        "data": {}
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.token
        },
        body: JSON.stringify(requestData)
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
            displayCartProducts(response);
        })
        .catch(error => {
            console.error('Error fetching cart data:', error);
        });
}

function displayCartProducts(cartProducts) {
    var cartContainer = document.getElementById("cart");
    cartContainer.innerHTML = "";

    if (cartProducts.length === 0) {
        var noProductFound = document.createElement("h1");
        noProductFound.textContent = "El carrito está vacío";
        cartContainer.appendChild(noProductFound);
    } else {
        var table = document.createElement("table");
        table.className = "cart-table";

        var thead = document.createElement("thead");
        var headerRow = document.createElement("tr");
        var thImage = document.createElement("th");  
        thImage.textContent = "Imagen";               
        var thName = document.createElement("th");
        thName.textContent = "Producto";
        var thQuantity = document.createElement("th");
        thQuantity.textContent = "Cantidad";
        var thPrice = document.createElement("th");
        thPrice.textContent = "Precio Unitario";
        var thSubtotal = document.createElement("th");
        thSubtotal.textContent = "Subtotal";

        headerRow.appendChild(thImage);             
        headerRow.appendChild(thName);
        headerRow.appendChild(thQuantity);
        headerRow.appendChild(thPrice);
        headerRow.appendChild(thSubtotal);

        thead.appendChild(headerRow);
        table.appendChild(thead);

        var tbody = document.createElement("tbody");

        cartProducts.forEach(function (value) {
            var row = document.createElement("tr");

            var cellImage = document.createElement("td"); 
            var image = document.createElement("img");   
            image.src = "../assets/images/products/" + value.image;  
            image.alt = value.name; 
            cellImage.appendChild(image); 

            var cellName = document.createElement("td");
            cellName.textContent = value.name;

            var cellQuantity = document.createElement("td");
            cellQuantity.textContent = value.quantity;

            var cellPrice = document.createElement("td");
            cellPrice.textContent = "$" + value.price.toLocaleString('es-MX');

            var cellSubtotal = document.createElement("td");
            cellSubtotal.textContent = "$" + value.subtotal.toLocaleString('es-MX');

            row.appendChild(cellImage);
            row.appendChild(cellName);
            row.appendChild(cellQuantity);
            row.appendChild(cellPrice);
            row.appendChild(cellSubtotal);

            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        cartContainer.appendChild(table);
    }
}

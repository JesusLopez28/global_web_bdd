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

function alertMessage(icon, title, text, confirmText = "", cancelText = "", showCancelButton = false, callback = null) {
    const dialog = document.createElement('div');
    dialog.className = 'custom-alert';
    dialog.innerHTML = `
        <div class="icon">${getIcon(icon)}</div>
        <div class="title">${title}</div>
        <div class="text">${text}</div>
        <div class="footer">
            ${confirmText && `<button class="confirm-button">${confirmText}</button>`}
            ${showCancelButton && cancelText ? `<button class="cancel-button">${cancelText}</button>` : ''}
        </div>
    `;

    document.body.appendChild(dialog);

    if (callback) {
        const confirmButton = dialog.querySelector('.confirm-button');
        const cancelButton = dialog.querySelector('.cancel-button');

        confirmButton.addEventListener('click', function () {
            document.body.removeChild(dialog);
            callback(true);
        });

        if (showCancelButton && cancelButton) {
            cancelButton.addEventListener('click', function () {
                document.body.removeChild(dialog);
                callback(false);
            });
        }
    } else if (!confirmText && !showCancelButton) {
        setTimeout(function () {
            document.body.removeChild(dialog);
        }, 1500);
    }
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
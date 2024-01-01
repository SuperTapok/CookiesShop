$(document).ready(function () {
    modalText.innerHTML = 'Форма некорректно заполнена!';
});

$("#form").submit( (e) => {
    e.preventDefault();
    form_data = new FormData($("#form")[0]),
    $.ajax({
        type: "POST",
        url: "/api/catalog/add_product",
        data: form_data,
        processData: false,
        contentType: false,
        success: function () {
            modalText.innerHTML = 'Товар добавлен!';
        },
    });
});

modalOk.onclick = function () { 
    if (modalText.innerHTML == 'Товар добавлен!') {
        location.reload();
    }
};
$("#form").submit( (e) => {
    e.preventDefault();
    form_data = new FormData($("#form")[0]),
    $.ajax({
        type: "POST",
        url: "/api/catalog/edit_product",
        data: form_data,
        processData: false,
        contentType: false,
        success: function () {
            modalText.innerHTML = 'Товар изменён!';
        },
    });
});
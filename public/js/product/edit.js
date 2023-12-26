$("#form").submit( (e) => {
    e.preventDefault();
    var form_data = $("#form").serialize();
    $.ajax({
        type: "POST",
        url: "/api/catalog/edit_product",
        data: form_data,
        success: function () {
            modalText.innerHTML = 'Товар изменён!';
        },
    });
});
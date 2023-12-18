$("#form").submit( (e) => {
    e.preventDefault();
    var form_data = $("#form").serialize();
    $.ajax({
        type: "POST",
        url: "/api/activity/reward_employee_api",
        data: form_data,
        success: function () {
            modalText.innerHTML = 'Сотрудник награждён!';
        },
    });
});
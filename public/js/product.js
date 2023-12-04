form.addEventListener('submit', () => {
    // e.preventDefault();
    var form_data = $(this).serialize(); // Собираем все данные из формы
    console.log( $( this ).serialize() );
    $.ajax({
        type: "POST",
        url: "/api/catalog/add_product",
        data: form_data,
        success: function () {
            alert("Ваше сообщение отправлено!");
        },
     });
});

// .submit(function (e) { // Устанавливаем событие отправки для формы с id=form
    
//  });


// $('.addProduct').click(function (e) { 
//     let employee_id = e.target.getAttribute('data-employee');
//     let product_id = e.target.getAttribute('data-product');
//     axios.post(`/api/cart/${employee_id}/add_product/${product_id}`).then((res) => {
//         if(res.data.success) {
//             modalText.innerHTML = res.data.response.message;
//         }
//     })
// });

// $('.del_product_btn').click(function (e) { 
//     confirmModalOk.setAttribute('data-product', e.target.getAttribute('data-product'));
// });

// confirmModalOk.onclick = function (e) { 
//     let product_id = e.target.getAttribute('data-product');
//     axios.post(`/api/catalog/delete_product/${product_id}`).then((res) => {
//         if(res.data.success) {
//             modalText.innerHTML = res.data.response.message;
//         }
//     })
// };

// modalOk.onclick = function () { 
//     window.location.href = '/'
// };

// changeVisibility.onclick = function (e) {
//     let product_id = e.target.getAttribute('data-product');
//     axios.post(`/api/catalog/hide_product/${product_id}`).then((res) => {
//         if(res.data.success) {
//             location.reload();
//         }
//     })
// };
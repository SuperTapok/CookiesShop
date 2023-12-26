$('.add_to_cart_btn').click(function (e) { 
    let employee_id = e.target.getAttribute('data-employee');
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/cart/${employee_id}/add_product/${product_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
        }
    })
});

$(document).ready(function () {
    var btns = document.querySelectorAll('button[id^="changeVisibility"]');

    for (var i=0, len=btns.length; i < len; i++) btns[i].onclick = changeVisibility;
});

function changeVisibility (e) {
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/catalog/hide_product/${product_id}`).then((res) => {
        if(res.data.success) {
            location.reload();
        }
    })
};
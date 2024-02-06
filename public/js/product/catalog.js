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

    var btns = document.querySelectorAll('button[id^="deleteFromFavourite"]');

    for (var i=0, len=btns.length; i < len; i++) btns[i].onclick = deleteFromFavourite;

    var btns = document.querySelectorAll('button[id^="addToFavourite"]');

    for (var i=0, len=btns.length; i < len; i++) btns[i].onclick = addToFavourite;

});

function changeVisibility (e) {
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/catalog/hide_product/${product_id}`).then((res) => {
        if(res.data.success) {
            location.reload();
        }
    })
};

function addToFavourite (e) {
    let employee_id = e.target.getAttribute('data-employee');
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/favourite/add_to_favourite/${employee_id}/${product_id}`).then((res) => {
        if(res.data.success) {
            location.reload();
        }
    })
};

function deleteFromFavourite (e) {
    let employee_id = e.target.getAttribute('data-employee');
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/favourite/delete_from_favourite/${employee_id}/${product_id}`).then((res) => {
        if(res.data.success) {
            location.reload();
        }
    })
};
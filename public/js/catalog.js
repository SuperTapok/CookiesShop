$('.add_to_cart_btn').click(function (e) { 
    let employee_id = e.target.getAttribute('data-employee');
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/cart/${employee_id}/add_product/${product_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
        }
    })
});

$('.del_product_btn').click(function (e) { 
    confirmModalOk.setAttribute('data-product', e.target.getAttribute('data-product'));
    confirmModalText.innerHTML ='Удалить товар?';
});

confirmModalOk.onclick = function (e) { 
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/catalog/delete_product/${product_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
        }
    })
};

modalOk.onclick = function () { 
    location.reload();
};

changeVisibility.onclick = function (e) {
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/catalog/hide_product/${product_id}`).then((res) => {
        if(res.data.success) {
            location.reload();
        }
    })
};
$('.del_from_cart_btn').click(function (e) { 
    let order_id = e.target.getAttribute('data-order');
    let product_id = e.target.getAttribute('data-product');
    axios.post(`/api/cart/${order_id}/delete_product/${product_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
        }
    })
});

modalOk.onclick = function () { 
    window.location.href = '/cart'
};

$('.pay_btn').click(function (e) {
    confirmModalText.innerHTML = 'Оплатить заказ?';
    confirmModalOk.setAttribute('data-employee', e.target.getAttribute('data-employee'));
    confirmModalOk.setAttribute('data-order', e.target.getAttribute('data-order'));
});

confirmModalOk.onclick = function (e) { 
    let employee_id = e.target.getAttribute('data-employee'); 
    let order_id = e.target.getAttribute('data-order');
    axios.post(`/api/cart/${employee_id}/pay/${order_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
            window.open(`/order?order_id=${order_id}`);
        }
    })
};
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
    window.location.href = '/catalog'
};
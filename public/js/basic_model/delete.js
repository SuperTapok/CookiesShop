$('.del_btn').click(function (e) { 
    confirmModalOk.setAttribute('data-product', e.target.getAttribute('data-route'));
    confirmModalText.innerHTML ='Удалить?';
});

confirmModalOk.onclick = function (e) { 
    let route = e.target.getAttribute('data-product');
    axios.post(route).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
        }
    })
};

modalOk.onclick = function () { 
    location.reload();
};
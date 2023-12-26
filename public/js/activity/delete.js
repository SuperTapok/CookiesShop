$('.del_btn').click(function (e) { 
    confirmModalOk.setAttribute('data-product', e.target.getAttribute('data-product'));
    confirmModalText.innerHTML = 'Удалить наградное действие?';
});

confirmModalOk.onclick = function (e) { 
    let activity_id = e.target.getAttribute('data-product');
    axios.post(`/api/activity/delete_activity/${activity_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
        }
    })
};

modalOk.onclick = function () { 
    location.reload();
};
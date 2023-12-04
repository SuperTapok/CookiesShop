$('.del_btn').click(function (e) { 
    let route = e.target.getAttribute('data-route');
    if (confirm('Удалить?')){
        axios.post(route).then((res) => {
            if(res.data.success) {
                alert(res.data.response.message);
            }
        })
    }
});
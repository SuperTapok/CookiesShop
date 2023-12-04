employeeSelect.addEventListener('change', function handleChange(event) {
    axios.get(`/api/orders/get_orders_by_employee/${event.target.value}`).then((res) => {
        if(res.data.success) {
            let html = '';

            for (let index = 0; index < res.data.response.data.length; index++) {
                const element = res.data.response.data[index];
                html += '<tr>'
                if (element['receipt_code'] == null) {
                    html += '<td scope="row"></td>';
                } else {
                    html += `<td scope="row">${element['receipt_code']}</td>`;
                }
                html += `<td>${ employeeSelect.options[employeeSelect.selectedIndex].text }</td>`;
                if (element['given_at'] == null) {
                    html += '<td><button class="btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Выдать заказ</button></td>';
                } else {
                    html += `<td>${element['given_at']}</td>`;
                }
                html += `<td><a href="${ element['receipt_url'] }">Чек</a></td></tr>`;
            }

            orderList.innerHTML = html;

        }
    })
});

receiptCode.addEventListener('change', (event) => {
    axios.get(`/api/orders/get_orders_by_code/${event.target.value}`).then((res) => {
        if(res.data.success) {
            let html = '';

            for (let index = 0; index < res.data.response.data.length; index++) {
                const element = res.data.response.data[index];
                html += '<tr>'
                if (element['receipt_code'] == null) {
                    html += '<td scope="row"></td>';
                } else {
                    html += `<td scope="row">${element['receipt_code']}</td>`;
                }
                html += `<td>${ employeeSelect.options[employeeSelect.selectedIndex].text }</td>`;
                if (element['given_at'] == null) {
                    html += '<td><button class="btn btn-primary" style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);">Выдать заказ</button></td>';
                } else {
                    html += `<td>${element['given_at']}</td>`;
                }
                html += `<td><a href="${ element['receipt_url'] }">Чек</a></td></tr>`;
            }

            orderList.innerHTML = html;

        }
    })
});

$('.giveOrder').click(function (e) {
    let order_id = e.target.getAttribute('data-order');
    axios.post(`/api/orders/give_order/${order_id}`).then((res) => {
        if(res.data.success) {
            modalText.innerHTML = res.data.response.message;
            
        }
    });
});

modalOk.onclick = function () { 
    window.location.href = '/orders';
};
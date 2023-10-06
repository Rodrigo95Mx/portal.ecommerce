$(document).ready(function () {
    $("#btnMyAccount").hide();
    $("#btnHome").show();
})

/**
 * OBTIENE LOS DETALLES DE UNA COMPRA
 */
function purchaseDetails(_purchaseId) {
    let ajaxData = new AjaxRequestClass(
        API_PURCHASEDETAILS,
        { shopping_history_id: _purchaseId },
        "Ocurrio un error al cerrar la sesion",
        'POST',
        true,
        true,
        purchaseDetailsRequest
    );

    ajaxRequestGenercic(ajaxData);
}

/**
 * RESPUESTA DEL AJAX 
 * @param {*} _data 
 */
function purchaseDetailsRequest(_data) {
    if (_data.status == undefined || _data.status.toUpperCase() == 'ERROR') {
        showAlertGeneric(_data.msg, 'error');
    } else {
        updateDetailPurchase(_data.data.products);
        $('#totalPurchase').text(parseFloat(_data.data.purchase.total_amount).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' }));
        $('#paymentMethod').text(`Tipo de pago: ${_data.data.purchase.payment_method}`);
        let shippingAddress = `${_data.data.purchase.address}, ${_data.data.purchase.state}, ${_data.data.purchase.city} C.P. ${_data.data.purchase.postal_code}`;
        $('#recipientName').text(`Recibe: ${_data.data.purchase.recipient_name}`);
        $('#shippingAddress').text(`Domicilio: ${shippingAddress}`);
        $("#modal-purchase-detail").modal({ backdrop: 'static', keyboard: false });
        modalLoaderClose();
    }
}

function updateDetailPurchase(_data) {
    let container = document.getElementById("detailPurchaseItem");
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }

    _data.forEach(item => {
        container.appendChild(addToDetailProduct(item));
    });
}

function addToDetailProduct(_item) {
    let div1 = document.createElement('div');
    div1.className = 'product-widget';

    let div2 = document.createElement('div');
    div2.className = 'product-img';
    let img = document.createElement('img');
    img.src = _item.image_url;
    div2.appendChild(img)

    let div3 = document.createElement('div');
    div3.className = 'product-body';
    let h3 = document.createElement('h3');
    h3.className = 'product-name';
    let a = document.createElement('a');
    a.innerText = _item.name;
    h3.appendChild(a);
    let h4 = document.createElement('h4');
    h4.className = 'product-price';
    let span1 = document.createElement('span');
    span1.className = 'qty';
    span1.innerText = `${_item.quantity}x`;
    let span2 = document.createElement('span');
    span2.innerText = parseFloat(_item.sale_price).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
    h4.appendChild(span1);
    h4.appendChild(span2);
    div3.appendChild(h3);
    div3.appendChild(h4);

    div1.appendChild(div2);
    div1.appendChild(div3);

    return div1;
}
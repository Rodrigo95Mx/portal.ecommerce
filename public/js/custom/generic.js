var shopping_carts = [];

class AjaxRequestClass {
    constructor(_url, _data, _msgError, _type = 'POST', _showLoader = false, _async = false, _function = null, _renewSession = true) {
        this.url = _url;
        this.data = _data;
        this.msgError = _msgError;
        this.type = _type;
        this.showLoader = _showLoader;
        this.async = _async;
        this.function = _function;
        this.renewSession = _renewSession;
    }
}

$(document).ready(function () {
    //MOSTRAR Y OCULTAR BOTONES SEGUN LA SESION
    showButtons();
    //FORMATO DE NUMERO SIN DECIMAL EN EL INPUT
    $('.numberForm').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    //FORMATO DE NUMERO CON DECIMAL EN EL INPUT
    $('.numberFormDecimal').on('input', function () {
        this.value = this.value.replace(/[^0-9,.{0,1}]/g, '').replace(/,/g, '.');
    });

    lottie.loadAnimation({
        container: document.getElementById(
            'loaderAnim'), // the dom element that will contain the animation
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: LOADER // the path to the animation json
    });

    let dataLocal = localStorage.getItem("shopping_carts");
    if (dataLocal != null) {
        shopping_carts = JSON.parse(dataLocal);
        updateDataCart();
    }
});

/**
 * MUESTRA/OCULTA BOTONES DE ACUERDO A LA SESION
 */
function showButtons() {
    if (session == 1) {
        $("#link_logout").show();
        $("#btnMyAccount").show();
        $("#link_login").hide();
        $("#link_register").hide();
    } else {
        $("#link_login").show();
        $("#link_register").show();
        $("#link_logout").hide();
        $("#btnMyAccount").hide();
    }
}

/**
 * CREA UNA PETICION AJAX GENERICO
 * @param {*} _ajaxData 
 * @returns 
 */
function ajaxRequestGenercic(_ajaxData) {
    let dataReturn = null;
    $.ajax({
        async: _ajaxData.async,
        url: _ajaxData.url,
        type: _ajaxData.type,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': X_CSRF_TOKEN,
        },
        data: _ajaxData.data,
        beforeSend: function () {
            if (_ajaxData.showLoader)
                modalLoaderOpen();
        },
        success: function (data) {
            //SIEMPRE AL REALIZAR UNA PETICION AJAX SE REINICIA EL CONTADOR
            if (_ajaxData.function != null)
                _ajaxData.function(data);
            else
                dataReturn = data;
        },
        error: function (err) {
            let msg = "";
            if (typeof err.responseJSON === 'undefined') { // devuelve true
                if (_ajaxData.msgError != "")
                    msg = _ajaxData.msgError;
                else
                    msg = "Ocurrio un error, intenta mas tarde"
            } else {
                msg = err.responseJSON.msg;
            }
            if (msg == 'Expired token' || msg == 'Invalid token') {
                modalLoaderClose();
                Swal.fire({
                    icon: 'error',
                    title: msg,
                    allowOutsideClick: false,
                    confirmButtonText: 'Aceptar',
                }).then(function (result) {
                    modalLoaderOpen();
                    logout();
                });
            } else {
                showAlertGeneric(msg, 'error');
            }
        },
    });

    return dataReturn;
}

/**
 * VALIDA SI UN TEXTO ESTA VACIO O NULO
 * @param {*} _string 
 * @returns 
 */
function stringIsNullOrEmpty(_string) {
    try {
        let stringVal = _string.trim();
        if (stringVal == null || stringVal == undefined || stringVal == '')
            return true;
        else
            return false;
    } catch (error) {
        return true;
    }
}

/**
 * VALIDA LOS CAMPOS DE UNA ARREGLO DE IDS SI TIENEN DATOS
 * @param {*} _arrayaTributes ID
 * @param {*} _subId TEXTO ANTES DEL ID
 * @returns 
 */
function validateFormArray(_arrayaTributes, _subId = '') {
    let data = {};
    let countError = 0;

    _arrayaTributes.forEach(element => {
        let valueItem = $(`#${_subId}${element}`).val();
        if (stringIsNullOrEmpty(valueItem)) {
            if ($(`#${_subId}${element}`).hasClass("input-required")) {
                $(`#${_subId}${element}`).addClass('is-invalid');
                countError++;
            }
        } else {
            $(`#${_subId}${element}`).removeClass('is-invalid');
            data[element] = valueItem;
        }
    });

    if (countError > 0) {
        showAlertGeneric('Debes agregar todos los campos obligatorios');
        return null;
    } else {
        return data;
    }
}

/**
 * LIMPIA UN FORMULARIO
 * @param {*} _arrayaTributes 
 * @param {*} _subId 
 * @returns 
 */
function clearForm(_arrayaTributes, _subId = '') {
    _arrayaTributes.forEach(element => {
        $(`#${_subId}${element}`).val('');
    });
}

/**
 * MUESTRA UN MODAL DE MENSAJE GENERICO
 * @param {*} _msg MENSAJE A MOSTRAR
 * @param {*} _icon ICONO DEL MODAL
 * @param {*} _reload INDIDCA SI AL ACEPTAR SE VA RECARGAR 
*/
function showAlertGeneric(_msg, _icon = 'error', _reload = false) {
    modalLoaderClose();
    Swal.fire({
        icon: _icon,
        title: _msg,
        allowOutsideClick: false,
        confirmButtonText: 'Aceptar',
    }).then(function (result) {
        if (_reload) {
            modalLoaderOpen();
            window.location.reload();
        }
    });
}

/**
 * MUESTRA EL MODAL DE CARGA
 */
function modalLoaderOpen() {
    $('#mod-loader').stop();
    $('#mod-loader').show();
    $('#mod-loader').css("opacity", 1);
    $("#mod-loader").animate({
        opacity: 1,
    }, 300, function () {

    });
}

/**
 * CIERRA EL MODAL DE CARGA
 */
function modalLoaderClose() {
    $('#mod-loader').stop();
    $("#mod-loader").animate({
        opacity: 0,
    }, 300, function () {
        $('#mod-loader').hide();
    });
}

/**
 * ABRE EL MODAL PARA EL LOGIN
 */
function showLogin() {
    $("#modal-login").modal({ backdrop: 'static', keyboard: false });
}

/**
 * ABRE EL MODAL PARA EL REGISTRO
 */
function showUserRegistration() {
    $("#modal-registration").modal({ backdrop: 'static', keyboard: false });
}

/**
 * REALIZA EL CIERRE DE SESION
 */
function logout() {
    let ajaxData = new AjaxRequestClass(
        API_LOGOUT,
        {},
        "Ocurrio un error al cerrar la sesion",
        'POST',
        true,
        true,
        logoutRequest
    );

    ajaxRequestGenercic(ajaxData);
}

/**
 * RESPUESTA DEL AJAX 
 * @param {*} _data 
 */
function logoutRequest(_data) {
    if (_data.status == undefined || _data.status.toUpperCase() == 'ERROR') {
        showAlertGeneric(_data.msg, 'error');
    } else {
        session = 0;
        openNewView(window.location.origin);
    }
}

/**
 * ABRE UNA NUEVA VISTA
 * @param {*} _url 
 */
function openNewView(_url) {
    //ABRIR MODAL DE CARGANDO
    modalLoaderOpen();
    //REDIRIGIR A LA NUEVA VISTA
    location.href = _url;
}

/**
 * DIRIGE A LA PAGINA PARA REALIZAR LA COMPRA
 * @param {*} _url 
 */
function buyCart(_url) {
    if (session == 1) {
        if (shopping_carts.length > 0)
            openNewView(_url);
        else
            showAlertGeneric('Debes agregar al menos un producto al carrito', 'warning');
    } else {
        showAlertGeneric('Inicia sesion para poder completar la compra', 'warning');
    }
}

/**
 * ACTUALIZA LOS DATOS DEL CARRITO
 */
function updateDataCart() {
    let container = document.getElementById("cartList");
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
    let countItemsCart = 0;
    let totalAmountCart = 0;
    shopping_carts.forEach(item => {
        let product = product_list.find((object) => object.id == item.product_id);
        container.appendChild(addToCartProduct(item, product));
        countItemsCart = countItemsCart + item.quantity;
        totalAmountCart = parseFloat(totalAmountCart + (item.quantity * product.price));
    });
    $('#countItemsCart').text(countItemsCart);
    $('#countItemsCartText').text(`${countItemsCart} Articulo(s) Seleccionados`);
    $('#totalAmountCart').text(`SUBTOTAL: ${totalAmountCart.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' })}`);
    //GUARDAR CARRITO EN LOCALSTORAGE
    localStorage.setItem("shopping_carts", JSON.stringify(shopping_carts));
    if (session == 1) {
        //SI ESTA INICIADA LA SESION SE ACTUALIZA EL CARRITO EN LA BASE DE DATOS
        updateShoppingCartDataBase();
    }
}

/**
 * AGREGA UN PRODUCTO AL CARRITO DE COMPRA
 * @param {*} _item 
 * @param {*} _product 
 * @returns 
 */
function addToCartProduct(_item, _product) {
    let div1 = document.createElement('div');
    div1.className = 'product-widget';

    let div2 = document.createElement('div');
    div2.className = 'product-img';
    let img = document.createElement('img');
    img.src = _product.image_url;
    div2.appendChild(img)

    let div3 = document.createElement('div');
    div3.className = 'product-body';
    let h3 = document.createElement('h3');
    h3.className = 'product-name';
    let a = document.createElement('a');
    a.innerText = _product.name;
    h3.appendChild(a);
    let h4 = document.createElement('h4');
    h4.className = 'product-price';
    let span1 = document.createElement('span');
    span1.className = 'qty';
    span1.innerText = `${_item.quantity}x`;
    let span2 = document.createElement('span');
    span2.innerText = parseFloat(_product.price).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
    h4.appendChild(span1);
    h4.appendChild(span2);
    div3.appendChild(h3);
    div3.appendChild(h4);

    let button = document.createElement('button');
    button.className = 'delete';
    let i = document.createElement('i');
    i.className = 'fa fa-close';
    button.setAttribute('onclick', `deleteToCartProduct(${_item.product_id})`);
    button.appendChild(i);

    div1.appendChild(div2);
    div1.appendChild(div3);
    div1.appendChild(button);

    return div1;
}

/**
 * ELIMINA UN PRODUCTO DEL CARRITO
 * @param {*} _productId 
 */
function deleteToCartProduct(_productId) {
    let new_shopping_carts = [];
    shopping_carts.forEach(element => {
        if (element.product_id != _productId)
            new_shopping_carts.push(element);
    });
    shopping_carts = new_shopping_carts;
    updateDataCart();
    if (typeof updateOrder === "function")
        updateOrder();

    showAlertGeneric('Producto eliminado del carrito', 'success');
}

/**
 * ACTUALIZA EL CARRITO DE COMPRA EN LA BASE DE DATOS
 * @returns 
 */
function updateShoppingCartDataBase() {
    let ajaxData = new AjaxRequestClass(
        API_UPDATESHOPPINGCART,
        { shopping_carts: shopping_carts },
        "Ocurrio un error al iniciar sesion",
        'POST',
        false,
        true,
        updateShoppingCartDataBaseRequest
    );

    ajaxRequestGenercic(ajaxData);
}

/**
 * RESPUESTA DEL AJAX 
 * @param {*} _data 
 */
function updateShoppingCartDataBaseRequest(_data) {
    if (_data.status == undefined || _data.status.toUpperCase() == 'ERROR') {
        showAlertGeneric(_data.msg, 'error');
    }
}
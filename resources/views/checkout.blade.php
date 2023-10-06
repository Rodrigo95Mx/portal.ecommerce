@extends('master')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">DIRECCIÓN DE ENVIO</h3>
                    </div>
                    <div class="form-group">
                        <input class="input input-required" type="text" id="recipient_name" placeholder="Nombre de quien recibe">
                    </div>
                    <div class="form-group">
                        <input class="input input-required" type="text" id="address" placeholder="Direccion">
                    </div>
                    <div class="form-group">
                        <input class="input input-required" type="text" id="city" placeholder="Ciudad">
                    </div>
                    <div class="form-group">
                        <input class="input input-required" type="text" id="state" placeholder="Estado">
                    </div>
                    <div class="form-group">
                        <input class="input input-required numberForm" type="text" id="postal_code" placeholder="Codigo Postal">
                    </div>
                </div>
            </div>
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Tu Orden</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCTO</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <div class="order-products" id="orderProduts">
                    </div>
                    <div class="order-col">
                        <div>Envio</div>
                        <div><strong>Gratis</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        <div><strong class="order-total" id="orderTotal">$0.00</strong></div>
                    </div>
                </div>
                <div class="payment-method">
                    <div class="input-radio">
                        <input type="radio" name="paymentMethod" id="payment_1" value="Tranferencia">
                        <label for="payment_1">
                            <span></span>
                            Tranferencia Bancaria
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="paymentMethod" id="payment_2" value="Paypal">
                        <label for="payment_2">
                            <span></span>
                            Paypal
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="input-checkbox">
                    <input type="checkbox" id="terms">
                    <label for="terms">
                        <span></span>
                        He leído y acepto los <a href="#">términos y condiciones</a>
                    </label>
                </div>
                <a onclick="buyCartList()" class="primary-btn order-submit">Realizar pedido</a>
            </div>
        </div>
    </div>
@stop

@section('customjs')
    <script>
        var API_BUYCARTLIST = @js(route('buyCartList'));
    </script>
    <script src="{{ asset('js/custom/checkout.js') }}"></script>
@stop

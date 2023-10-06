@extends('master')

@section('css')
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .tdStyle {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        button {
            display: block;
            margin: 0 auto;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Hola {{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['lastname2'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Historial de compras</h3>
                </div>
                <div class="order-summary">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 25%;">Fecha</th>
                                <th scope="col" style="width: 25%;">Monto</th>
                                <th scope="col" style="width: 25%;">Metodo de pago</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $item)
                                <tr>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>${{ number_format($item['total_amount'], 2, '.', ',') }}</td>
                                    <td>{{ $item['payment_method'] }}</td>
                                    <td class="tdStyle">
                                        <button type="button" onclick="purchaseDetails({{ $item['id'] }})"
                                            class="btn btn-success btn-sm">
                                            Detalles
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modals')
    <!--MODAL DETALLE COMPRA-->
    <div class="modal fade" id="modal-purchase-detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-details">
                                <h2 class="product-name">Datos de envio</h2>
                                <p id="recipientName"></p>
                                <p id="shippingAddress"></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-details">
                                <h2 class="product-name">Datos de compra</h2>
                                <div class="cart-list" id="detailPurchaseItem">
                                </div>
                                <div class="cart-summary">
                                    <small>Envio: Gratis</small>
                                    <h5>Total: <strong class="order-total" id="totalPurchase"></strong></h5>
                                    <small id="paymentMethod"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('customjs')
    <script>
        var API_PURCHASEDETAILS = @js(route('purchaseDetails'));
    </script>
    <script src="{{ asset('js/custom/profile.js') }}"></script>
@stop

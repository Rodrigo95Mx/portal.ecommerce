@extends('master')

@section('css')
    <style>
        /*===========================
                         CHAT BOOT MESSENGER
                       ===========================*/
        #Smallchat .Messages,
        #Smallchat .Messages_list {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .chat_close_icon {
            cursor: pointer;
            color: #fff;
            font-size: 16px;
            position: absolute;
            right: 12px;
            z-index: 9;
        }

        .chat_on {
            position: fixed;
            z-index: 10;
            width: 45px;
            height: 45px;
            right: 15px;
            bottom: 20px;
            background-color: #8a57cf;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            padding: 9px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
            cursor: pointer;
            display: block;
        }

        .chat_on_icon {
            color: #fff;
            font-size: 25px;
            text-align: center;
        }

        /*
                    #Smallchat,#Smallchat * {
                     box-sizing:border-box;
                     -webkit-font-smoothing:antialiased;
                     -moz-osx-font-smoothing:grayscale;
                     -webkit-tap-highlight-color:transparent
                    }
                    */
        #Smallchat .Layout {
            pointer-events: auto;
            box-sizing: content-box !important;
            z-index: 999999999;
            position: fixed;
            bottom: 20px;
            min-width: 50px;
            max-width: 300px;
            max-height: 30px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: end;
            -webkit-justify-content: flex-end;
            -ms-flex-pack: end;
            justify-content: flex-end;
            border-radius: 50px;
            box-shadow: 5px 0 20px 5px rgba(0, 0, 0, .1);
            -webkit-animation: appear .15s cubic-bezier(.25, .25, .5, 1.1);
            animation: appear .15s cubic-bezier(.25, .25, .5, 1.1);
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
            opacity: 0;
            -webkit-transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1), min-width .2s cubic-bezier(.25, .25, .5, 1), max-width .2s cubic-bezier(.25, .25, .5, 1), min-height .2s cubic-bezier(.25, .25, .5, 1), max-height .2s cubic-bezier(.25, .25, .5, 1), border-radius 50ms cubic-bezier(.25, .25, .5, 1) .15s, background-color 50ms cubic-bezier(.25, .25, .5, 1) .15s, color 50ms cubic-bezier(.25, .25, .5, 1) .15s;
            transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1), min-width .2s cubic-bezier(.25, .25, .5, 1), max-width .2s cubic-bezier(.25, .25, .5, 1), min-height .2s cubic-bezier(.25, .25, .5, 1), max-height .2s cubic-bezier(.25, .25, .5, 1), border-radius 50ms cubic-bezier(.25, .25, .5, 1) .15s, background-color 50ms cubic-bezier(.25, .25, .5, 1) .15s, color 50ms cubic-bezier(.25, .25, .5, 1) .15s
        }

        #Smallchat .Layout-right {
            right: 20px
        }

        #Smallchat .Layout-open {
            overflow: hidden;
            min-width: 300px;
            max-width: 300px;
            height: 500px;
            max-height: 500px;
            border-radius: 10px;
            color: #fff;
            -webkit-transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1.1), min-width .2s cubic-bezier(.25, .25, .5, 1.1), max-width .2s cubic-bezier(.25, .25, .5, 1.1), max-height .2s cubic-bezier(.25, .25, .5, 1.1), min-height .2s cubic-bezier(.25, .25, .5, 1.1), border-radius 0ms cubic-bezier(.25, .25, .5, 1.1), background-color 0ms cubic-bezier(.25, .25, .5, 1.1), color 0ms cubic-bezier(.25, .25, .5, 1.1);
            transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1.1), min-width .2s cubic-bezier(.25, .25, .5, 1.1), max-width .2s cubic-bezier(.25, .25, .5, 1.1), max-height .2s cubic-bezier(.25, .25, .5, 1.1), min-height .2s cubic-bezier(.25, .25, .5, 1.1), border-radius 0ms cubic-bezier(.25, .25, .5, 1.1), background-color 0ms cubic-bezier(.25, .25, .5, 1.1), color 0ms cubic-bezier(.25, .25, .5, 1.1);
        }

        #Smallchat .Layout-expand {
            height: 500px;
            min-height: 500px;
            display: none;
        }

        #Smallchat .Layout-mobile {
            bottom: 10px
        }

        #Smallchat .Layout-mobile.Layout-open {
            width: calc(100% - 20px);
            min-width: calc(100% - 20px)
        }

        #Smallchat .Layout-mobile.Layout-expand {
            bottom: 0;
            height: 100%;
            min-height: 100%;
            width: 100%;
            min-width: 100%;
            border-radius: 0 !important
        }

        @-webkit-keyframes appear {
            0% {
                opacity: 0;
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            to {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        @keyframes appear {
            0% {
                opacity: 0;
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            to {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        #Smallchat .Messenger_messenger {
            position: relative;
            height: 100%;
            width: 100%;
            min-width: 300px;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column
        }

        #Smallchat .Messenger_header,
        #Smallchat .Messenger_messenger {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex
        }

        #Smallchat .Messenger_header {
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            padding-left: 10px;
            padding-right: 40px;
            height: 40px;
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }


        #Smallchat .Messenger_header h4 {
            opacity: 0;
            font-size: 16px;
            -webkit-animation: slidein .15s .3s;
            animation: slidein .15s .3s;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards
        }

        #Smallchat .Messenger_prompt {
            margin: 0;
            font-size: 16px;
            line-height: 18px;
            font-weight: 400;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis
        }

        @-webkit-keyframes slidein {
            0% {
                opacity: 0;
                -webkit-transform: translateX(10px);
                transform: translateX(10px)
            }

            to {
                opacity: 1;
                -webkit-transform: translateX(0);
                transform: translateX(0)
            }
        }

        @keyframes slidein {
            0% {
                opacity: 0;
                -webkit-transform: translateX(10px);
                transform: translateX(10px)
            }

            to {
                opacity: 1;
                -webkit-transform: translateX(0);
                transform: translateX(0)
            }
        }

        #Smallchat .Messenger_content {
            height: 450px;
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: #fff;
        }

        #Smallchat .Messages {
            position: relative;
            -webkit-flex-shrink: 1;
            -ms-flex-negative: 1;
            flex-shrink: 1;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 10px;
            background-color: #fff;
            -webkit-overflow-scrolling: touch;
        }





        #Smallchat .Input {
            position: relative;
            width: 100%;
            -webkit-box-flex: 0;
            -webkit-flex-grow: 0;
            -ms-flex-positive: 0;
            flex-grow: 0;
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            padding-top: 17px;
            padding-bottom: 15px;
            color: #96aab4;
            background-color: #fff;
            border-top: 1px solid #e6ebea;
        }

        #Smallchat .Input-blank .Input_field {
            max-height: 20px;
        }

        #Smallchat .Input_field {
            width: 100%;
            resize: none;
            border: none;
            outline: none;
            padding: 0;
            padding-right: 0px;
            padding-left: 0px;
            padding-left: 20px;
            padding-right: 75px;
            background-color: transparent;
            font-size: 16px;
            line-height: 20px;
            min-height: 20px !important;
        }

        #Smallchat .Input_button-emoji {
            right: 45px;
        }

        #Smallchat .Input_button {
            position: absolute;
            bottom: 15px;
            width: 25px;
            height: 25px;
            padding: 0;
            border: none;
            outline: none;
            background-color: transparent;
            cursor: pointer;
        }

        #Smallchat .Input_button-send {
            right: 15px;
        }

        #Smallchat .Input-emoji .Input_button-emoji .Icon,
        #Smallchat .Input_button:hover .Icon {
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out;
        }

        #Smallchat .Input-emoji .Input_button-emoji .Icon path,
        #Smallchat .Input_button:hover .Icon path {
            fill: #2c2c46;
        }

        .Message {
            padding: 10px;
            margin-bottom: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .Sender {
            display: flex;
            align-items: center;
        }

        .Sender img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .Sender span {
            margin-left: 10px;
        }

        .Timestamp {
            text-align: right;
            font-size: 12px;
            color: #ccc;
        }

        .Text {
            font-size: 16px;
            line-height: 1.5em;
        }

        /* Estilos para el chat */
        .chat-container {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: 20px;
        }

        .message {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            max-width: 80%;
        }

        .sender-message {
            align-self: flex-end;
            background-color: #3F51B5;
            color: white;
        }

        .receiver-message {
            align-self: flex-start;
            background-color: #ECEFF1;
            color: #333;
        }

        /* Estilos para el botón de enviar */
        .send-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #3F51B5;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilos para el área de texto de entrada */
        .input-area {
            display: flex;
        }

        .input-field {
            flex-grow: 1;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div id="Smallchat">
                <div class="Layout Layout-open Layout-expand Layout-right"
                    style="background-color: #3F51B5;color: rgb(255, 255, 255);opacity: 5;border-radius: 10px;">
                    <div class="Messenger_messenger">
                        <div class="Messenger_header" style="background-color: rgb(22, 46, 98); color: rgb(255, 255, 255);">
                            <span class="chat_close_icon">
                                <i class="fa fa-window-close" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="Messenger_content">
                            <div class="Messages">
                                <div class="Messages_list">
                                    <div id="Smallchat">
                                        <div class="Messenger" id="containerMessage">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Input Input-blank">
                                <textarea class="Input_field" id="textMenssageSend" placeholder="Enviar mensaje" style="height: 20px;"></textarea>
                                <button onclick="sendMessage()" class="Input_button Input_button-send">
                                    <div class="Icon" style="width: 18px; height: 18px;">
                                        <svg width="57px" height="54px" viewBox="1496 193 57 54" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="width: 18px; height: 18px;">
                                            <g id="Group-9-Copy-3" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd"
                                                transform="translate(1523.000000, 220.000000) rotate(-270.000000) translate(-1523.000000, -220.000000) translate(1499.000000, 193.000000)">
                                                <path
                                                    d="M5.42994667,44.5306122 L16.5955554,44.5306122 L21.049938,20.423658 C21.6518463,17.1661523 26.3121212,17.1441362 26.9447801,20.3958097 L31.6405465,44.5306122 L42.5313185,44.5306122 L23.9806326,7.0871633 L5.42994667,44.5306122 Z M22.0420732,48.0757124 C21.779222,49.4982538 20.5386331,50.5306122 19.0920112,50.5306122 L1.59009899,50.5306122 C-1.20169244,50.5306122 -2.87079654,47.7697069 -1.64625638,45.2980459 L20.8461928,-0.101616237 C22.1967178,-2.8275701 25.7710778,-2.81438868 27.1150723,-0.101616237 L49.6075215,45.2980459 C50.8414042,47.7885641 49.1422456,50.5306122 46.3613062,50.5306122 L29.1679835,50.5306122 C27.7320366,50.5306122 26.4974445,49.5130766 26.2232033,48.1035608 L24.0760553,37.0678766 L22.0420732,48.0757124 Z"
                                                    id="sendicon" fill="#96AAB4" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===============CHAT ON BUTTON STRART===============-->
                <div class="chat_on">
                    <span class="chat_on_icon">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                    </span>
                </div>
                <!--===============CHAT ON BUTTON END===============-->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div id="aside" class="col-md-3">
                <div class="aside">
                    <h3 class="aside-title">Categorias</h3>
                    <div class="checkbox-filter">

                        <div class="input-checkbox">
                            <input type="checkbox" id="category-2">
                            <label for="category-2">
                                <span></span>
                                Tecnologia
                                <small>(9)</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="store" class="col-md-9">
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ asset($item['image_url']) }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-name"><a href="#">{{ $item['name'] }}</a></h3>
                                    <h4 class="product-price">${{ number_format($item['price'], 2, '.', ',') }}</h4>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn" onclick="addToCart({{ $item['id'] }})"><i
                                            class="fa fa-shopping-cart"></i> Agregar al
                                        carrito</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('modals')
    <!--MODAL LOGIN-->
    <div class="modal fade" id="modal-login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Iniciar sesion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="login_email">Correo<span class="text-danger">*</span></label>
                        <input type="text" name="login_email" class="form-control" id="login_email"
                            placeholder="Ingrese su correo">
                    </div>
                    <div class="mb-3">
                        <label for="login_password">Contraseña<span class="text-danger">*</span></label>
                        <input type="password" name="login_password" class="form-control" id="login_password"
                            placeholder="Ingrese su Contraseña">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-wAuto" onclick="login()">
                        Iniciar session
                    </button>
                </div>
            </div>

        </div>

    </div>
    <!-- MODAL REGISTRO -->
    <div class="modal fade" id="modal-registration">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="register_name">Nombre</label>
                        <input type="text" name="register_name" class="form-control input-required"
                            id="register_name">
                    </div>
                    <div class="mb-3">
                        <label for="register_lastname">Apellido Paterno</label>
                        <input type="text" name="register_lastname" class="form-control input-required"
                            id="register_lastname">
                    </div>
                    <div class="mb-3">
                        <label for="register_lastname2">Apellido Materno</label>
                        <input type="text" name="register_lastname2" class="form-control input-required"
                            id="register_lastname2">
                    </div>
                    <div class="mb-3">
                        <label for="register_email">Correo</label>
                        <input type="text" name="register_email" class="form-control input-required"
                            id="register_email">
                    </div>
                    <div class="mb-3">
                        <label for="register_phone">Telefono</label>
                        <input type="text" name="register_phone" class="form-control input-required numberForm"
                            id="register_phone">
                    </div>
                    <div class="mb-3">
                        <label for="register_password">Contraseña</label>
                        <input type="password" name="register_password" class="form-control input-required"
                            id="register_password">
                    </div>
                    <div class="mb-3">
                        <label for="register_password_confirmation">Confirmar contraseña</label>
                        <input type="password" name="register_password_confirmation" class="form-control input-required"
                            id="register_password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-wAuto" onclick="createRegister()">
                        Registrarse
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-chat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <header class="msger-header">
                        <div class="msger-header-title">
                            <i class="fas fa-comment-alt"></i> SimpleChat
                        </div>
                        <div class="msger-header-options">
                            <span><i class="fas fa-cog"></i></span>
                        </div>
                    </header>

                    <main class="msger-chat">
                        <div class="msg left-msg">
                            <div class="msg-img"
                                style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"></div>

                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">BOT</div>
                                    <div class="msg-info-time">12:45</div>
                                </div>

                                <div class="msg-text">
                                    Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                                </div>
                            </div>
                        </div>

                        <div class="msg right-msg">
                            <div class="msg-img"
                                style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"></div>

                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">Sajad</div>
                                    <div class="msg-info-time">12:46</div>
                                </div>

                                <div class="msg-text">
                                    You can change your name in JS section!
                                </div>
                            </div>
                        </div>
                    </main>

                    <form class="msger-inputarea">
                        <input type="text" class="msger-input" placeholder="Enter your message...">
                        <button type="submit" class="msger-send-btn">Send</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-wAuto" onclick="createRegister()">
                        Registrarse
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('customjs')
    <script>
        var API_SENDMSG = @js(route('sendMessageChat'));
        $(document).ready(function() {
            $(".chat_on").click(function() {
                $(".Layout").toggle();
                $(".chat_on").hide(300);
            });

            $(".chat_close_icon").click(function() {
                $(".Layout").hide();
                $(".chat_on").show(300);
            });

        });
    </script>
    <script src="{{ asset('js/custom/index.js') }}?v=1.00"></script>
@stop

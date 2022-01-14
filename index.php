<?php
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
$enabled = get_config('local_forgotpassword', 'enabled');

if(!$enabled){
    echo "plugin not enabled";
    die;
}
?>

<html>
    <head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" crossorigin="anonymous"></script>
    <style type="text/css">
        body{
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .title{
            font-weight: 600;
            font-size: 2em;
            padding: 15px;
            border-bottom: 1px solid;
            border-color: rgba(0,0,0,0.1);
        }
        .card{
            border: 1px solid;
            border-radius: 5px;
            border-color: rgba(0, 0, 0,0.1);
            max-width:450px;
            background-color:rgba(233, 236, 239, 0.1);
        }
        .card-body{
            padding:15px;
            border-bottom: 1px solid;
            border-color: rgba(0,0,0,0.1)
        }
        .card-action{
            padding:15px;
            display: flex;
            justify-content: end;
        }
        .card-action > button {
            margin-left:7px;
            padding: 10px;
            border: 0px;
            border-radius:5px;
        }
        .card-subtitle{            
            font-size: 17px;
            line-height: 20px;
            margin-bottom:10px;
        }
        .input-card{
            border-radius: 6px;
            border:1px solid #ccd0d5;
            /* color: #8a8d91; */
            font-family: Roboto-Regular, Helvetica, Arial, sans-serif;
            font-size: 16px;
            height: auto;
            margin-bottom: 0;
            padding: 16px 0 16px 16px;
            width: 100%;
        }
        .search{
            color:white;
            background-color:#007bff;
            opacity: 0.5;
        }
        .search:hover{
            opacity: 1;
            cursor: pointer;
        }
        .card-action > button.cancel{
            cursor: pointer;
            opacity: 0.5;
        }
        .card-action > button.cancel:hover{
            cursor: pointer;
            opacity: 1;
        }
        .errorInput{
            border:1px solid red;
        }
        .snackbar{
            padding: 10px;
            position: absolute;
            bottom: 0;
            color: white;
            margin: 10px;
            border-radius: 5px;
        }
        .error-snack{
            background-color: red;
        }
        .not-show{
            display: none;
        }
        .show{
            display: block;
        }
    </style>
    </head>
    <body>
        <div class="card">
            <div class="title">
                Recupera tu cuenta
            </div>
            <div class="card-body">
                <div class="card-subtitle">
                    Ingresa tu correo electronico o el nombre de tu usuario para poder recuperar tu cuenta.
                </div>
                <div>
                    <input type="text" class="input-card" placeholder="Correo electronico o usuario">
                </div>
            </div>
            <div class="card-action">
                <button class="cancel"> Cancelar </button>
                <button class="search"> Buscar </button>
            </div>
        </div>
        <div class="snackbar error-snack not-show">
            <span class="snackbar-body">
                hola
            </span>
        </div>
    </body>
    <footer>
        <script>
            $(document).ready(() => {
                $(".search").click(() => {
                    var input = $(".input-card").val();
                    if (input.length > 0) {
                        $(".input-card").removeClass("errorInput")
                        $.ajax({
                            type: "POST",
                            url: "./script.php",
                            data:{
                                input:input
                            },
                            success: (response) => {
                                var resp = JSON.parse(response);
                                if(!resp.status){
                                    $(".snackbar-body").text(resp.message);
                                    $(".snackbar").addClass("show");
                                    setTimeout(() => {
                                        $(".snackbar").removeClass("show");
                                        $(".snackbar").addClass("not-show");
                                    }, 800);
                                }else{
                                    window.location.href = "./messagesended.php";
                                }
                            }
                        })
                    } else {
                        $(".input-card").addClass("errorInput")
                    }
                });
            })
        </script>
    </footer>
</html>

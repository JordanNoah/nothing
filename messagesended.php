<?php
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
$enabled = get_config('local_forgotpassword', 'enabled');

if(!$enabled){
    echo "plugin not enabled";
    die;
}
?>

<html>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card{
            width: 243px;
        }
        .title{
            font-size: 1.5em;
            font-weight: 600;
            letter-spacing: 0.3;
            margin-bottom:5px;
        }
        .sub-title{
            margin-top:5px;
        }
    </style>
    <body>
        <div class="card">
            <div class="title">
                Restaurando contraseña
            </div>
            <div class="sub-title">
                Deberias revisar tu email.
                Te llegara un email pronto para continuar.
            </div>
        </div>
    </body>
</html>
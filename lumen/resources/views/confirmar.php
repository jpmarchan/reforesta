<html lang='<?php echo $idioma; ?>'>
<?php
  $GLOBALS['lang']=$idioma;

  function texto($espanol,$ingles){    
    if($GLOBALS['lang']=='es'){
      echo $espanol;
    }else{
      echo $ingles;
    }
  }
?>

<head>
    <base href="https://reforesta.pe/">
    <meta charset='UTF-8'>
    <style>
        #confirmacion,
        #success {
            font-family: Helvetica;
            text-align: center;
        }

        #confirmacion h3 {
            border-bottom: 2px solid #B4D341;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        #confirmacion>p {
            margin-bottom: 0px;
            margin-top: 10px;
        }

        #confirmacion .confirm-message {
            border-top: 2px solid #B4D341;
        }

        #confirmacion .confirm-message p {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        #confirmar,
        #cerrar {
            width: 50%;
            max-width: 200px;
            height: 50px;
            padding-top: 16px;
            margin: auto;
            background: #333;
            cursor: pointer;
            color: white;
            text-align: center;
            box-sizing: border-box;
            font-weight: bold;
            border-radius: 25px;
            background: #372F29;
            font-size: 18px;
        }

        #confirmar {
            float: left;
            min-width: 170px;
            margin-bottom: 10px;
            margin-top: 10px;
            margin-left: 10px;
        }

        #editar {
            width: 50%;
            max-width: 200px;
            height: 50px;
            padding-top: 16px;
            margin: auto;
            text-align: center;
            background: #B4D340;
            color: #372F29;
            cursor: pointer;
            font-weight: bold;
            float: left;
            font-size: 18px;
            box-sizing: border-box;
            border-radius: 25px;
            min-width: 170px;
            margin-bottom: 10px;
            margin-top: 10px;
            margin-left: 10px;
        }

        img {
            max-width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            box-shadow: 2px 2px 5px 2px rgb(200, 200, 200);
            height: 63%;
        }

        .wrapper {
            position: fixed;
            top: 50%;
            left: 50%;
        }

        body {
            -webkit-text-size-adjust: 100%;
        }
    </style>
    <meta name="viewport" content="width=device-width; initial-scale=1.0;" />

</head>

<body>
    <div id="confirmacion">
        <h3><?php texto('VISTA PREVIA DEL CERTIFICADO','CERTIFICATE PREVIEW') ?></h3>
        <p><?php texto('Este es el certificado que se enviará a tu correo electrónico','This is the certificate that will be sent to your email') ?>: <b><?php echo $request["email"]; ?></b>. </p>
        <?php //echo http_build_query( $request  ); ?>
        <img src="<?php echo $_GET['urlCertificado']."?rand=". rand(); ?>" />
        <div class="confirm-message">
            <p><b><?php texto('¿Estás seguro que los datos que has ingresado son correctos?','Are you sure that the data you have entered is correct?') ?></b><br>
            <?php texto('Una vez confirmado ya no podrás cambiar el certificado','Once confirmed, you will no longer be able to change the certificate') ?>.
            </p>
        </div>
        <div id="editar"> <?php texto('EDITAR','EDIT') ?> </div>
        <div id="confirmar"> <?php texto('CONFIRMAR','CONFIRM') ?> </div>
    </div>
    <div id="success" style="display:none; text-align:center;">
        Gracias por adoptar tu árbol. <br>
        El certificado ha sido enviado exitosamente a tu correo.<br>
        Si no lo encuentras, revisa tu correo de no deseados y en caso no te haya llegado, contáctanos por favor. <br>
        <br>
        <div id="cerrar"> CERRAR </div>
    </div>

    <script src="js/jquery.js"></script>    
    <script>
        var sending = false;
        $("#confirmar").click(function() {
            if (!sending) {

                $('#response-error').hide();
                $('#response-success').hide();

                $('#response-success').show().html("...enviando");
                $('#canvasloader').show();
                sending = true;
                $.post("certificados/grabar?<?php echo http_build_query( $request ); ?>", {
                    confirm: true
                }, 'JSON').done(function(data) {
                    var obj = JSON.parse(data);
                    if (obj.result === 0) {
                        parent.$('#response-error').show().parent().show().parent().show();
                        parent.$('#response-success').hide();
                        parent.$('#response-error').html(obj.error);
                    } else {
                        parent.$("#formArbol")[0].reset();
                        parent.$('#response-success').show().html(obj.success);
                        parent.$(".numArboles").text(obj.numArboles);
                        parent.window.open("https://reforesta.pe/"+obj.certificadoUrl+"?r="+Math.random());
                    }
                    sending = false;
                    $('#canvasloader').hide();
                    $("#confirmacion").hide();
                    $("#success").show();
                    parent.$.fancybox.update()
                    //parent.$.fancybox.close();
                });

            }
        });
        $('#canvasloader').hide();
        $("#cerrar, #editar").click(function() {
            parent.$.fancybox.close();
        });
    </script>
</body>

</html>
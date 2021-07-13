<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <style>p{margin-top: 20px;}
        .im p {
          color:#3c342e;
        }
        </style>
    </head>
  <body style="margin:0px; padding:0px; font-family:Helvetica">
   <table border="0" cellpadding="0" cellspacing="0" width="800px" align="center">
      <tr>
        <td>
          <img src="https://reforesta.pe/mailing/rxn-banner.jpg" style="display:block" alt="REFORESTAMOS POR NATURALEZA - CONSERVAMOS POR NATURALEZA" />
        <td>
      </tr>
      <tr>
        <td style="background:#f7f9d4; padding: 65px; color: #3c342e; font-size:15px; padding-top: 45px; padding-bottom: 20px;">

          Hola <?php echo $toName;?>, 
          <br />
          <p style="text-align: center; font-size: 16px;">
            <?php if($cantidad==1) { ?>  
              Tu donación por 1 árbol ha sido registrada. Este es tu código:
            <?php } else { ?>
              Tu donación por <?php echo $cantidad; ?> árboles ha sido registrada. Estos son tus códigos:              
            <?php } ?>
            <br> <b> <?php echo $codigo; ?> </b>
            <p> &nbsp; </p>

            <p>
            Ahora ingresa a <a style="color:#3c342e;" href="https://reforesta.pe">www.reforesta.pe</a> y completa tus datos en la sección “Crea tu
certificado”. El código te servirá para generar el certificado.
            </p>

            <p>
              ¡Gracias por colaborar con Reforestamos por Naturaleza!
            </p>

          <p><a style="color:#3c342e;" href="https://reforesta.pe">Reforestamos por Naturaleza</a>, es una campaña de <a style="color:#3c342e;" href="http://www.conservamospornaturaleza.org/">Conservamos por Naturaleza</a>, que contribuye con iniciativas de conservación, para que sigan protegiendo la Amazonía peruana. 
          <p> &nbsp; </p>
           
        </td>
      </tr>
      <tr>
        <td>
          <table border="0" cellpadding="0" cellspacing="0" width="800px" align="center" height="105px" style="background: #3c342e; padding-left: 18px; padding-top: 10px;">
            <tr>
              <td>
                <p style="text-align: center;">
                  <img src="https://reforesta.pe/mailing/banner_footer.png" width="42%" />
                </p>
                <p style="font-size:14px; color: white; text-align: center;">
                  <i>Copyright @ 2020 Conservamos por Naturaleza. All rights reserved.</i><br>
                  Estás recibiendo este correo porque adoptaste un árbol de Reforestamos por Naturaleza.
                </p>
                <p style="font-size:14px; color: white; text-align: center;">
                  <b>Our mailing address is:</b><br>
                  Conservamos por Naturaleza<br>
                  Av. Prolongación Arenales 437 - San Isidro<br>
                  San Isidro <br>
                  Lima Lima 18<br>
                  Perú
                </p>
              </td>              
            </tr>
          </table>
        </td>
      </tr>
    </table>
	

	</body>
</html>
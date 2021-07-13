<!DOCTYPE html>
<!--[if IE 6]>	  <html lang='es' class='lt-ie7 lt-ie8 lt-ie9 lt-ie10 lt-ie11'>  <![endif]-->
<!--[if IE 7]>	  <html lang='es' class='lt-ie8 lt-ie9 lt-ie10 lt-ie11'>  <![endif]-->
<!--[if IE 8]>    <html lang='es' class='lt-ie9 lt-ie10 lt-ie11'> <![endif]-->
<!--[if IE 9]>    <html lang='es' class='lt-ie10 lt-ie11'> <![endif]-->
<!--[if IE 10]>   <html lang='es' class='lt-ie11'> <![endif]-->
<!--[if IE 11]><!-->
<html lang='es'>
<!--<![endif]-->
<?php
/*print_r($website[2]);
 exit();*/
?>

<head>
  <meta charset='UTF-8'>
  <base href="./">
  <title>Reforestamos por Naturaleza</title>
  <meta name="description" content="Reforestamos por Naturaleza es una campaña de Conservamos por Naturaleza, que permite a cualquier persona apoyar iniciativas de conservación en todo el país, a través de la adopción de árboles nativos.">
  <link rel="shortcut icon" href="https://www.conservamospornaturaleza.org/wp-content/themes/conservamosTheme/images/favicon.ico" type="image/x-icon" />
  <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui'>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
  <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
  <link href="css/green.css" rel="stylesheet">
  <link href="css/datepicker.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery.bxslider.min.css" type="text/css" />
  <script src="js/jquery.js"></script>
  <script src="js/icheck.min.js"></script>
  <script src="js/jquery.lettering.min.js"></script>
  <script src="js/jquery.bxslider.min.js"></script>
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
  <link href="css/main.css?v=2" rel="stylesheet" type="text/css">

  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

</head>

<body>
  <div id="topHeader" class="container">
    <a target="_blank" href="http://www.conservamospornaturaleza.org/">
      <div id="logoConservamos" class="left"></div>
    </a>
    <ul>
      <li class="goToNav" data-goto="adopta">ADOPTA UN ÁRBOL</li>
      <li class="goToNav" data-goto="que-es">¿QUÉ ES RXN?</li>
      <li class="goToNav" data-goto="proyectos">PROYECTOS</li>
      <li class="goToNav" data-goto="aliados">ALIADOS</li>
    </ul>
    <div class="social right">
      <a href="https://www.facebook.com/conservamospornaturaleza" target="_blank"><span class="icon small iconFb"></span></a>
      <a href="https://www.twitter.com/conservamos" target="_blank"><span class="icon small iconTwitter"></span></a>
      <a href="https://vimeo.com/conservamospornaturaleza/" target="_blank"><span class="icon small iconVimeo"></span></a>
      <a href="https://www.youtube.com/user/Conservamos" target="_blank"><span class="icon small iconYt"></span></a>
      <a href="https://instagram.com/conservamos" target="_blank"><span class="icon small iconInstagram"></span></a>
    </div>
  </div>
  <header class="container">
    <div id="logo"></div>
    <div id="sloganContainer" class="container">
      <h2>YA SE HAN ADOPTADO <div class="boxLetters"><?php echo $num_arboles;
                                                      ?></div> ÁRBOLES Y RECAUDAMOS <span>S/</span>
        <div class="boxLetters"><?php echo $num_arboles * 25;
                                ?></div> PARA INICIATIVAS DE CONSERVACIÓN VOLUNTARIA
      </h2>
    </div>
    <div class="creditos">Foto: Claudio Moro</div>
  </header>

  <div id="bodyContainer">
    <div id="adopta" class="instructions">
      <h2>ADOPTA UN ÁRBOL</h2>
      <div class="instructions-content">
        <div class="left">
          <h3>AÚN NO TENGO MI CÓDIGO:</h3>
          <ul>
            <li><span class="number">1.</span><img src="img/instructions1.png" />
              <p><?php echo $website[9]->valor; ?></p>
              <div class="desc-instruc big">
                <?php echo $website[5]->valor; ?><a href="#" class="mypopup" data-popupname="popup/datos_cuenta">(<?php echo $website[13]->valor; ?>)</a>
              </div>
            </li>
            <li><span class="number">2.</span><img src="img/instructions2.png" />
              <p><?php echo $website[10]->valor; ?></p>
              <div class="desc-instruc big">
                <?php echo $website[6]->valor; ?>
              </div>
            </li>
            <li class="clearfix"></li>
          </ul>
        </div>
        <div class="right">
          <h3>YA TENGO MI CÓDIGO:</h3>
          <ul>
            <li><span class="number">3.</span><img src="img/instructions3.png" />
              <p><?php echo $website[11]->valor; ?></p>
              <div class="desc-instruc big">
                <?php echo $website[7]->valor; ?>
              </div>
            </li>
            <li><span class="number">4.</span><img src="img/instructions4.png" />
              <p><?php echo $website[12]->valor; ?></p>
              <div class="desc-instruc big">
                <?php echo $website[8]->valor; ?>
              </div>
            </li>
            <li class="clearfix"></li>
          </ul>
        </div>
        <div class="clearfix"></div>
        <p class="note">Si quieres adoptar más de 10 árboles a la vez por favor escríbenos a: <a href="mailto:reforesta@conservamos.org"><span>reforesta@conservamos.org</span></a></p>
      </div>
    </div>

    <div class="right formContainer section" name="adopta-name">
      <div class="headerForm">
        <h2>CREA TU CERTIFICADO</h2>
      </div>

      <div class="bodyForm">
        <form id="formArbol">

          <div>
            
          </div>
          <div class="escogeOpcion">
            <div class="inputRow radioRow">
              <h3>EL ÁRBOL ES PARA</h3>
              <div class="radioRowCenter">
                <span class="radioAndLabel">
                  <label for="mi">
                    <img style="margin:auto; display:block;" src="img/iconMi.png" />
                    <span class="text-radio">Mi</span>
                    <input name="para" id="mi" value="0" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="alguienMas">
                    <img style="margin:auto; display:block;" src="img/iconAlguienQuiero.png" />
                    <span class="text-radio">Alguien que quiero</span>
                    <input name="para" id="alguienMas" value="4" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="matrimonio">
                    <img style="margin:auto; display:block;" src="img/iconMatrimonio.png" />
                    <span class="text-radio">Un matrimonio</span>
                    <input name="para" value="1" id="matrimonio" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="fallece">
                    <img style="margin:auto; display:block;" src="img/iconFallece.png" />
                    <span class="text-radio">Una persona que nos dejó</span>
                    <input name="para" id="fallece" value="2" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="bebe">
                    <img style="margin:auto; display:block;" src="img/iconBebe.png" />
                    <span class="text-radio">Un bebé recién llegado</span>
                  </label>
                  <input name="para" id="bebe" value="3" type="radio" class="radioInput" />
                </span>
              </div>
              <div style="width: 85%">
              

                <div class="inputRow" style="height: auto;">
                  <textarea id="deCertificado" name="deCertificado" placeholder="Dedicatoria (max 220 caracteres)" maxlength="220" rows="4"></textarea>
                </div>
                <div class="inputRow">
                  <input name="nombreCertificado" id="nombreCertificado" placeholder="Para" />
                </div>
                <div class="inputRow">
                  <input name="fecha" id="fechaCertificado" placeholder="Fecha (Opcional)" />
                </div>
                

              </div>
            </div>            
          </div>
          <div class="formRight">
            <h3>INFORMACIÓN DE PAGO</h3>
            <div class="inputRow">
              <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="double" />
            </div>
            <div class="inputRow">
              <input type="text" name="apellido" placeholder="Apellido" id="apellido" class="double right" />
            </div>
            <div class="inputRow">
              <input type="text" name="dni" id="dni" placeholder="DNI / RUC / Pasaporte" class="double" />
              <select name="tipodocumento" id="tipodocumento" class="turnintodropdown double right">
                <option value="-1">Tipo de Documento</option>
                <option value="1">DNI</option>
                <option value="2">RUC</option>
                <option value="3">Pasaporte</option>
              </select>
            </div>
            <div class="inputRow">
              <select name="nacionalidad" id="nacionalidad" class="turnintodropdown double right">
                <option value="-1">Nacionalidad</option>
              </select>
            </div>
            <div class="inputRow">
              <input type="text" name="email" id="email" placeholder="Correo Electrónico" />
            </div>
            <div class="inputRow" style="height:auto; min-height: 45px;"><input id="newsletter" value="1" type="checkbox" name="newsletter" checked /><label for="newsletter"> Deseo suscribirme al boletín de noticias de CxN.</label></div>
            <div class="inputRow metodopago" style="height:auto; min-height: 45px;"><label class="etiqueta">Indica el método de pago que utilizaste</label></div>
            <div class="inputRow metodopago" style="height:auto; min-height: 45px;">
              
              <span class="radioAndLabel">
                <label for="bcp">                                    
                  <input name="metodo" value="bcp" id="bcp" type="radio" class="radioInput" />
                  <span class="text-radio">BCP</span>
                </label>
                <label for="scotiabank">                                    
                  <input name="metodo" value="scotiabank" id="scotiabank" type="radio" class="radioInput" />
                  <span class="text-radio">Scotiabank</span>
                </label>
                <label for="payu">                                    
                  <input name="metodo" value="payu" id="payu" type="radio" class="radioInput" />
                  <span class="text-radio">PayU</span>
                </label>
                <label for="otro">                  
                  <input name="metodo" value="-1" id="otro" type="radio" class="radioInput" />
                </label>
                <input type="text" name="otrotxt" id="otrotxt" placeholder="Otro" />
              </span>

            </div>

            

            
            <div class="inputRow">
              <input type="text" name="codigo" id="codigo" placeholder="Ingresa tu código" />
            </div>
            <!--h4><b>Si el árbol no es para ti, </b><br>ingresa los datos de la(s) persona(s) para quien está dedicado:</h4>
            <div id="inputsTodos">
              <div class="inputRow">
                <input name="nombreCertificado" id="nombreCertificado" placeholder="Nombre de la(s) persona(s)" />
              </div>
            </div-->   

          </div>          
          <div class="formFinal">
            <br><br>
            <div>
              <a id="enviar"> ADOPTAR ÁRBOL </a>
            </div>
            <ul id="errorBox" display="block;">
              <li><label id="response-error" class="error" style="display: inline;"></label></li>
            </ul>
            <div id="response-success"></div>
            <br>
          </div>
          <div class="faq"><p>&nbsp;<br> ¿Tienes alguna duda? <b>Revisa aquí:</b> <a href="#" class="mypopup" data-popupname="popup/faq" data-sizeh="600">PREGUNTAS FRECUENTES</a></p></div>
          <br><br>
        </form>
      </div>
    </div>
    <div id="que-es" class="que-es">
      <h2>¿QUÉ ES REFORESTAMOS?</h2>
      <div class="left">
        <?php echo $website[0]->valor; ?>
        <div class="video">
          <?php echo $website[2]->valor; ?>
        </div>
      </div>
      <div class="right">
        <?php echo $website[1]->valor; ?>
        <h2>NOTICIAS</h2>
        <ul class="noticias">
          <?php
          $c = 0;
          foreach ($noticias as $noticia) {
            if ($c % 2 == 0) {
              echo '<li><a href="' . $noticia->url . '" target="_blank"><img src="' . $noticia->imagen . '" /><h3>' . $noticia->titulo . '</h3></a>';
            }
            if ($c % 2 == 1) {
              echo '<a href="' . $noticia->url . '" target="_blank"><img src="' . $noticia->imagen . '" /><h3>' . $noticia->titulo . '</h3></a></li>';
            }
            $c = $c + 1;
          }
          ?>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div>
    <div id="proyectos" class="proyectosContainer">
      <div class="proyectos">
        <h2>PROYECTOS</h2>
        <div class="left">
          <h3>¿En qué áreas de conservación reforestamos y qué logramos con tus donaciones?</h3>
        </div>
        <div class="right">
          <p>Aprende más sobre las áreas de conservación que participan en la campaña, y los diferentes proyectos que se implementan gracias a tus donaciones.</p>
        </div>
        <div class="clearfix"></div>
       
        
        <ul class="areas">

          <?php
          foreach ($areas as $area) { ?>
            <li class="mypopup" data-popupname="popup/proyecto_conservacion" data-params="id=<?php echo  $area->id ?>" data-sizew="1200" data-sizeh="600">
              <img src="lumen/storage/app/public/proyecto<?php echo  $area->id ?>.jpg" />
              <div class="circle">
                <h4><?php echo  $area->titulo  ?></h4>
                <span>+ INFO</span>
              </div>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <div id="aliados" class="aliadosContainer">
      <div class="aliados">
        <h2>ALIADOS</h2>
        <div class="left">
          <?php echo $website[3]->valor; ?>
        </div>
        <img src="lumen/storage/app/images/logos_2019.png" />
      </div>
    </div>
    <footer>
      <div class="footerContainer">
        <div class="column">
          <div class="sponsors">
            <a target="_blank" href="http://www.conservamospornaturaleza.org/" class="conservamosLogoLink">
              <div id="logoConservamos"></div>
            </a>
            <a target="_blank" href="http://www.spda.org.pe/" class="spdaLogoLink">
              <div id="spdaLogo"></div>
            </a>
          </div>
          <div>
            <?php echo $website[4]->valor; ?>
          </div>
        </div>
        <div class="column">
          <ul>
            <li class="goToNav" data-goto="adopta">ADOPTA UN ÁRBOL</li>
            <li class="goToNav" data-goto="que-es">¿QUÉ ES RXN?</li>
            <li class="goToNav" data-goto="proyectos">PROYECTOS</li>
            <li class="goToNav" data-goto="aliados">ALIADOS</li>
            <li><a target="_blank" href="http://issuu.com/conservamospornaturaleza/docs/politicas_y_condiciones_de_reforest">POLÍTICAS Y CONDICIONES</a></li>
            <li><a href="#" class="mypopup" data-popupname="popup/faq" data-sizeh="600">FAQ</a></li>
          </ul>
        </div>
        <div class="column">
          <form id="signup" class="formee" action="./subscribe" method="post">
            <fieldset>
              <legend>ÚNETE AL BOLETÍN</legend>
              <div>
                <label for="fname"></label> <input name="fname" id="fname" type="text" placeholder="Nombre*" />
              </div>
              <div>
                <label for="lname"></label> <input name="lname" id="lname" type="text" placeholder="Apellidos*" />
              </div>
              <div>
                <label for="email_s"></label> <input name="email_s" id="email_s" type="text" placeholder="Correo*" />
              </div>
              <div>
                <input class="right inputnew" type="submit" title="SUSCRIBIRME AL BOLETÍN" value="SUSCRIBIRME AL BOLETÍN" />
              </div>
            </fieldset>
          </form>
          <div id="response"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </footer>
    <img class="hiddenPick" src="img/logoConservamos_icon.png" />
    <img class="hiddenPick" src="img/iFb_b.png" />
    <img class="hiddenPick" src="img/iTwitter_b.png" />
    <img class="hiddenPick" src="img/iVimeo_b.png" />
    <img class="hiddenPick" src="img/iYt_r.png" />
    <img class="hiddenPick" src="img/iInstagram_b.png" />

    <script src="js/jquery.validate.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/datepicker.es.js"></script>
    <script src="js/navigate.js"></script>
    <script src="js/main.js?v=2"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
      $('.areas').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1263,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 947,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 633,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]
      });
    </script>
</body>

</html>